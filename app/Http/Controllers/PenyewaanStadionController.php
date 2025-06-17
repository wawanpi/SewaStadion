<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanStadion;
use App\Models\Stadion;
use App\Models\HargaSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PenyewaanStadionController extends Controller
{
    private const SLOT_WAKTU = [
        1 => ['start' => '06:00', 'end' => '12:00'],
        2 => ['start' => '13:00', 'end' => '18:00'],
        3 => ['start' => '00:00', 'end' => '23:59'],
    ];

    public function index()
    {
        $penyewaanStadions = PenyewaanStadion::with(['stadion', 'user'])->latest()->get();
        return view('penyewaan-stadion.admin.adminindex', compact('penyewaanStadions'));
    }

    public function create()
    {
        $stadions = Stadion::all();
        $slots = [
            1 => 'Pagi (06:00 - 12:00)',
            2 => 'Sore (13:00 - 18:00)',
            3 => 'Full Day (00:00 - 23:59)',
        ];

        $bookedDates = PenyewaanStadion::whereIn('status', ['Menunggu', 'Diterima'])
            ->pluck('tanggal_mulai')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        return view('penyewaan-stadion.User.BuatPesanan', compact('stadions', 'slots', 'bookedDates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'durasi_hari' => 'required|integer|min:1',
            'slot_waktu' => 'required|in:1,2,3',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan_tambahan' => 'nullable|string|max:255',
        ]);

        $kondisiMapping = [1 => 'pagi-siang', 2 => 'siang-sore', 3 => 'full-day'];
        $kondisi = $kondisiMapping[$validated['slot_waktu']] ?? null;

        if (!$kondisi) {
            return back()->withInput()->withErrors(['slot_waktu' => 'Slot waktu tidak valid.']);
        }

        if (in_array($validated['slot_waktu'], [1, 2]) && $validated['durasi_hari'] > 1) {
            return back()->withInput()->withErrors([
                'durasi' => 'Slot waktu Pagi atau Sore hanya boleh dipilih untuk 1 hari.'
            ]);
        }

        $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
            ->where('kondisi', $kondisi)
            ->first();

        if (!$hargaSewa || !$hargaSewa->harga) {
            return back()->withInput()->withErrors(['harga' => 'Harga sewa belum tersedia untuk kondisi ini.']);
        }

        for ($i = 0; $i < $validated['durasi_hari']; $i++) {
            $tanggal = Carbon::parse($validated['tanggal_mulai'])->addDays($i)->toDateString();

            if ($this->isJadwalBentrok($validated['stadion_id'], $tanggal, $validated['slot_waktu'])) {
                return back()->withInput()->withErrors([
                    'tanggal_sewa' => "Jadwal untuk tanggal $tanggal dan slot waktu ini sudah dipesan."
                ]);
            }
        }

        for ($i = 0; $i < $validated['durasi_hari']; $i++) {
            $tanggal = Carbon::parse($validated['tanggal_mulai'])->addDays($i)->toDateString();
            $waktuSelesai = $this->hitungWaktuSelesai($tanggal, $validated['slot_waktu'], 1)->toDateTimeString();
            $durasiJam = $this->hitungDurasiSewa($tanggal, $validated['slot_waktu'], $waktuSelesai);

            $data = [
                'user_id' => Auth::id(),
                'stadion_id' => $validated['stadion_id'],
                'tanggal_mulai' => $tanggal,
                'tanggal_selesai' => $tanggal,
                'durasi' => $durasiJam,
                'slot_waktu' => $validated['slot_waktu'],
                'kondisi' => $kondisi,
                'harga' => $hargaSewa->harga,
                'status' => 'Menunggu',
                'catatan_tambahan' => $validated['catatan_tambahan'] ?? null,
                'waktu_selesai' => $waktuSelesai,
            ];

            if ($request->hasFile('bukti_pembayaran')) {
                $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            PenyewaanStadion::create($data);
        }

        return redirect()->route('penyewaan-stadion.my')->with('success', 'Booking berhasil dibuat.');
    }

    public function myBookings()
    {
        $bookings = PenyewaanStadion::where('user_id', Auth::id())->with('stadion')->latest()->get();
        return view('penyewaan-stadion.User.my_bookings', compact('bookings'));
    }

    public function approve(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Diterima']);
        return back()->with('success', 'Booking disetujui.');
    }

    public function reject(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Ditolak']);
        return back()->with('success', 'Booking ditolak.');
    }

    public function uploadBuktiPembayaran(Request $request, PenyewaanStadion $booking)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ]);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($request->hasFile('bukti_pembayaran')) {
            if ($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran)) {
                Storage::disk('public')->delete($booking->bukti_pembayaran);
            }

            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $booking->update(['bukti_pembayaran' => $path]);

            return back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }

    private function isJadwalBentrok(int $stadionId, string $tanggal, int $slotWaktu): bool
    {
        return PenyewaanStadion::where('stadion_id', $stadionId)
            ->where('tanggal_mulai', $tanggal)
            ->where('slot_waktu', $slotWaktu)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->exists();
    }

    private function hitungWaktuSelesai(string $tanggal, int $slotWaktu, int $durasi): Carbon
    {
        $start = Carbon::parse($tanggal);

        $slot = self::SLOT_WAKTU[$slotWaktu] ?? self::SLOT_WAKTU[1];
        $start->setTimeFromTimeString($slot['start']);
        $batasSelesai = Carbon::parse($tanggal . ' ' . $slot['end']);
        $end = $start->copy()->addHours($durasi);

        return $end->lessThanOrEqualTo($batasSelesai) ? $end : $batasSelesai;
    }

    private function hitungDurasiSewa(string $tanggal, int $slotWaktu, string $waktuSelesai): int
    {
        $slot = self::SLOT_WAKTU[$slotWaktu] ?? null;
        if (!$slot) return 0;

        $start = Carbon::parse($tanggal . ' ' . $slot['start']);
        $end = Carbon::parse($waktuSelesai);

        return max(1, ceil($end->diffInHours($start)));
    }

    public function updateStatus(Request $request, PenyewaanStadion $booking, string $status)
    {
        $allowedStatuses = ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return back()->with('error', 'Status tidak valid.');
        }

        $booking->update(['status' => $status]);
        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function lihatJadwal()
    {
        $jadwals = PenyewaanStadion::with('stadion', 'user')->get();
        return view('penyewaan-stadion.User.LihatJadwal', compact('jadwals'));
    }

    public function finish($id)
    {
        $penyewaan = PenyewaanStadion::findOrFail($id);

        if ($penyewaan->status === 'Selesai') {
            return redirect()->back()->with('info', 'Penyewaan sudah selesai.');
        }

        if ($penyewaan->status !== 'Diterima') {
            return redirect()->back()->with('error', 'Penyewaan harus disetujui dulu.');
        }

        $penyewaan->status = 'Selesai';
        $penyewaan->save();

        return redirect()->back()->with('success', 'Penyewaan telah selesai.');
    }

    public function hitungHargaTotal(Request $request)
    {
        $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'slot_waktu' => 'required|in:1,2,3',
            'durasi' => 'required|integer|min:1',
        ]);

        $kondisiMapping = [1 => 'pagi-siang', 2 => 'siang-sore', 3 => 'full-day'];
        $kondisi = $kondisiMapping[$validated['slot_waktu']];

        $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
            ->where('kondisi', $kondisi)
            ->first();

        if (!$hargaSewa) {
            return response()->json(['error' => 'Harga sewa tidak ditemukan.'], 404);
        }

        $totalHarga = $hargaSewa->harga * $validated['durasi'];

        return response()->json([
            'total_harga' => $totalHarga,
            'harga_per_hari' => $hargaSewa->harga,
            'durasi' => $validated['durasi'],
        ]);
    }

    public function showPembayaran()
    {
        $booking = PenyewaanStadion::where('user_id', Auth::id())
            ->where('status', 'Diterima')
            ->whereNull('bukti_pembayaran')
            ->latest()
            ->first();

        return view('penyewaan-stadion.User.Pembayaran', compact('booking'));
    }

    public function getKetersediaan(Request $request)
    {
        $stadionId = $request->input('stadion_id');
        $startDate = $request->input('start_date', now()->toDateString());
        $endDate = $request->input('end_date', now()->addDays(30)->toDateString());

        $bookings = PenyewaanStadion::where('stadion_id', $stadionId)
            ->whereBetween('tanggal_mulai', [$startDate, $endDate])
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->get();

        $data = [];

        foreach ($bookings as $booking) {
            $tgl = $booking->tanggal_mulai;
            $kondisi = $booking->kondisi;

            if (!isset($data[$tgl])) {
                $data[$tgl] = [
                    'pagi-siang' => false,
                    'siang-sore' => false,
                    'full-day' => false,
                ];
            }

            $data[$tgl][$kondisi] = true;
        }

        $tanggalPenuh = [];
        foreach ($data as $tgl => $slots) {
            if ($slots['pagi-siang'] && $slots['siang-sore'] && $slots['full-day']) {
                $tanggalPenuh[] = $tgl;
            }
        }

        return response()->json([
            'data' => $data,
            'tanggal_penuh' => $tanggalPenuh,
        ]);
    }
}
