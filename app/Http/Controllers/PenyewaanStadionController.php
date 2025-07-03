<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanStadion;
use App\Models\Stadion;
use App\Models\HargaSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PenyewaanStadionController extends Controller
{
    private const SLOT_WAKTU = [
        1 => ['start' => '06:00', 'end' => '12:00'], // Pagi-siang (6 jam)
        2 => ['start' => '13:00', 'end' => '19:00'], // Siang-sore (6 jam) - Diubah dari 18:00 ke 19:00
        3 => ['start' => '00:00', 'end' => '23:59'], // Full day (24 jam)
    ];

    public function adminIndex(Request $request)
    {
        $query = PenyewaanStadion::with(['stadion:id,nama', 'user:id,name'])
            ->select([
                'id', 'user_id', 'stadion_id', 'tanggal_mulai', 'slot_waktu',
                'waktu_selesai', 'durasi_hari', 'durasi_jam', 'kondisi',
                'harga', 'bukti_pembayaran', 'status', 'catatan_tambahan',
                'created_at'
            ]);
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }
        
        // Pencarian berdasarkan nama penyewa
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        
        $penyewaanStadions = $query->latest()->paginate(10);
        
        // Hitung jumlah per status untuk statistik
        $counts = [
            'menunggu' => PenyewaanStadion::where('status', 'Menunggu')->count(),
            'diterima' => PenyewaanStadion::where('status', 'Diterima')->count(),
            'ditolak' => PenyewaanStadion::where('status', 'Ditolak')->count(),
            'selesai' => PenyewaanStadion::where('status', 'Selesai')->count(),
        ];
        
        return view('penyewaan-stadion.admin.adminindex', compact('penyewaanStadions', 'counts'));
    }

    public function create(Request $request)
    {
        $stadionId = $request->query('stadion_id');
        
        $stadions = $stadionId 
            ? Stadion::where('id', $stadionId)->get()
            : Stadion::all();

        $slots = [
            1 => 'Pagi (06:00 - 12:00)',
            2 => 'Sore (13:00 - 18:00)',
            3 => 'Full Day (00:00 - 23:59)',
        ];

        $bookedDates = PenyewaanStadion::whereIn('status', ['Menunggu', 'Diterima'])
            ->pluck('tanggal_mulai')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        return view('penyewaan-stadion.User.BuatPesanan', [
            'stadions' => $stadions,
            'slots' => $slots,
            'bookedDates' => $bookedDates,
            'selectedStadionId' => $stadionId // Tambahkan ini
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'durasi_hari' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->slot_waktu != 3 && $value > 1) {
                        $fail('Slot waktu Pagi/Sore hanya boleh 1 hari.');
                    }
                }
            ],
            'slot_waktu' => 'required|in:1,2,3',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan_tambahan' => 'nullable|string|max:255',
        ]);

        // Get pricing information
        $kondisiMapping = [1 => 'pagi-siang', 2 => 'siang-sore', 3 => 'full-day'];
        $kondisi = $kondisiMapping[$validated['slot_waktu']];
        
        try {
            $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
                ->where('kondisi', $kondisi)
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'slot_waktu' => 'Harga sewa untuk slot waktu ini belum diatur. Silakan hubungi administrator.'
                ]);
        }

        // Check if price is zero or negative
        if ($hargaSewa->harga <= 0) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'slot_waktu' => 'Harga sewa tidak valid (Rp 0). Silakan hubungi administrator.'
                ]);
        }

        // Calculate time values
        $startDate = Carbon::parse($validated['tanggal_mulai']);
        $slotConfig = self::SLOT_WAKTU[$validated['slot_waktu']];
        
        // Set waktu mulai sesuai slot
        $validated['tanggal_mulai'] = $startDate->copy()
            ->setTime(
                explode(':', $slotConfig['start'])[0],
                explode(':', $slotConfig['start'])[1]
            );
        
        // Hitung waktu selesai
        $validated['waktu_selesai'] = $startDate->copy()
            ->addDays($validated['durasi_hari'] - 1)
            ->setTime(
                explode(':', $slotConfig['end'])[0],
                explode(':', $slotConfig['end'])[1]
            );
        
        // Hitung durasi jam (6 jam untuk pagi/siang, 24 jam untuk full day)
        $validated['durasi_jam'] = $validated['durasi_hari'] * 
            ($validated['slot_waktu'] == 3 ? 24 : 6);
            
        $validated['harga'] = $hargaSewa->harga * $validated['durasi_hari'];
        $validated['user_id'] = auth()->id();
        $validated['kondisi'] = $kondisi;
        
        // Handle file upload
        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        // Check for schedule conflicts
        if ($this->isJadwalBentrok(
            $validated['stadion_id'],
            $validated['tanggal_mulai']->format('Y-m-d'),
            $validated['slot_waktu']
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'tanggal_mulai' => 'Tanggal yang dipilih sudah dipesan. Silakan pilih tanggal lain.'
                ]);
        }

        PenyewaanStadion::create($validated);

        return redirect()->route('penyewaan-stadion.my')
            ->with('success', 'Pemesanan berhasil dibuat. Silakan upload bukti pembayaran.');
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
        $existingBookings = PenyewaanStadion::where('stadion_id', $stadionId)
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('waktu_selesai', '>=', $tanggal)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->get();

        foreach ($existingBookings as $booking) {
            // Full day booking blocks everything
            if ($booking->kondisi === 'full-day') {
                return true;
            }

            // Jika booking existing adalah slot yang sama
            if ($booking->slot_waktu == $slotWaktu) {
                return true;
            }

            // Jika memilih full day dan ada booking apapun di tanggal tersebut
            if ($slotWaktu == 3 && ($booking->slot_waktu == 1 || $booking->slot_waktu == 2)) {
                return true;
            }
        }

        return false;
    }

    private function hitungWaktuSelesai(string $tanggal, int $slotWaktu): Carbon
    {
        $slot = self::SLOT_WAKTU[$slotWaktu] ?? self::SLOT_WAKTU[1];
        return Carbon::parse($tanggal . ' ' . $slot['end']);
    }

    private function hitungDurasiSewa(string $tanggalMulai, int $slotWaktu, string $waktuSelesai): int
    {
        $start = Carbon::parse($tanggalMulai); // Sudah mengandung waktu yang benar
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
            return response()->json([
                'error' => 'Harga sewa untuk slot waktu ini belum diatur. Silakan hubungi admin.'
            ], 404);
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
        $slotWaktu = $request->input('slot_waktu');
        
        if (!$stadionId) {
            return response()->json([
                'data' => [],
                'fully_booked_dates' => [],
                'partially_booked_dates' => []
            ]);
        }

        $bookings = PenyewaanStadion::where('stadion_id', $stadionId)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->get();

        $data = [];
        $fullyBookedDates = [];
        $partiallyBookedDates = [];

        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->tanggal_mulai);
            $end = Carbon::parse($booking->waktu_selesai);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $dateStr = $date->toDateString();
                
                if (!isset($data[$dateStr])) {
                    $data[$dateStr] = [
                        'pagi-siang' => false,
                        'siang-sore' => false,
                        'full-day' => false,
                    ];
                }

                $data[$dateStr][$booking->kondisi] = true;

                if ($booking->kondisi === 'full-day') {
                    $data[$dateStr]['pagi-siang'] = true;
                    $data[$dateStr]['siang-sore'] = true;
                }
            }
        }

        foreach ($data as $date => $slots) {
            if ($slots['full-day']) {
                $fullyBookedDates[] = $date;
                continue;
            }
            
            if ($slots['pagi-siang'] && $slots['siang-sore']) {
                $fullyBookedDates[] = $date;
                continue;
            }
            
            if ($slots['pagi-siang'] || $slots['siang-sore']) {
                $partiallyBookedDates[] = [
                    'date' => $date,
                    'pagi-siang' => $slots['pagi-siang'],
                    'siang-sore' => $slots['siang-sore']
                ];
            }
        }

        return response()->json([
            'data' => $data,
            'fully_booked_dates' => $fullyBookedDates,
            'partially_booked_dates' => $partiallyBookedDates
        ]);
    }

    public function cetakTiketPdf($id)
    {
        $booking = PenyewaanStadion::with(['stadion', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Hanya boleh cetak jika status Selesai
        if ($booking->status !== 'Selesai') {
            abort(403, 'Tiket hanya bisa dicetak untuk pesanan yang sudah selesai');
        }

        $qrCode = QrCode::size(100)->generate('TiketID:' . $booking->id);

        $pdf = Pdf::loadView('penyewaan-stadion.User.tiket-pdf', [
            'booking' => $booking,
            'qrCode' => $qrCode
        ]);

        return $pdf->download('tiket-stadion-' . $booking->id . '.pdf');
    }
}