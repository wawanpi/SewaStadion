<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanStadion;
use App\Models\Stadion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PenyewaanStadionController extends Controller
{
    // Definisikan slot waktu sebagai konstanta agar lebih jelas
    private const SLOT_WAKTU = [
        1 => ['start' => '06:00', 'end' => '12:00'],
        2 => ['start' => '13:00', 'end' => '18:00'],
        3 => ['start' => '00:00', 'end' => '23:59:59'], // Full day
    ];

    public function index()
    {
        $penyewaanStadions = PenyewaanStadion::with(['stadion', 'user'])->get();
        return view('penyewaan-stadion.Admin.Adminindex', compact('penyewaanStadions'));
    }

    public function create()
    {
        $stadions = Stadion::all();
        return view('penyewaan-stadion.create', compact('stadions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_sewa' => 'required|date|after_or_equal:today',
            'durasi' => 'required|integer|min:1',
            'slot_waktu' => 'required|in:1,2,3',
            'catatan_tambahan' => 'nullable|string',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ], [
            'tanggal_sewa.after_or_equal' => 'Tanggal sewa harus hari ini atau setelahnya.',
            'bukti_pembayaran.mimes' => 'File bukti pembayaran harus berupa gambar atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran file tidak boleh melebihi 5 MB.',
            'slot_waktu.in' => 'Slot waktu tidak valid.',
        ]);

        if ($this->isJadwalBentrok($validated['stadion_id'], $validated['tanggal_sewa'], $validated['slot_waktu'])) {
            return redirect()->back()->withInput()->withErrors(['tanggal_sewa' => 'Jadwal untuk stadion dan slot waktu ini sudah dipesan.']);
        }

        $data = $validated;
        $data['user_id'] = Auth::id();
        $data['status'] = 'Menunggu';
        $data['waktu_selesai'] = $this->hitungWaktuSelesai($data['tanggal_sewa'], $data['slot_waktu'], $data['durasi']);

        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        PenyewaanStadion::create($data);

        return redirect()->route('penyewaan-stadion.my')->with('success', 'Booking berhasil dibuat, silakan tunggu persetujuan admin.');
    }

    public function myBookings()
    {
        $bookings = PenyewaanStadion::where('user_id', Auth::id())
            ->with('stadion')
            ->orderByDesc('created_at')
            ->get();

        return view('penyewaan-stadion.my_bookings', compact('bookings'));
    }

    // Tambahkan middleware atau pengecekan admin sebelum akses adminIndex
    public function adminIndex()
    {
        $penyewaanStadions = PenyewaanStadion::with(['user', 'stadion'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.bookings.index', compact('penyewaanStadions'));
    }

    public function approve(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Diterima']);
        return redirect()->back()->with('success', 'Booking berhasil disetujui.');
    }

    public function reject(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Ditolak']);
        return redirect()->back()->with('success', 'Booking berhasil ditolak.');
    }

    public function uploadBuktiPembayaran(Request $request, PenyewaanStadion $booking)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'bukti_pembayaran.mimes' => 'File harus berupa gambar atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 5MB.',
        ]);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->hasFile('bukti_pembayaran')) {
            if ($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran)) {
                Storage::disk('public')->delete($booking->bukti_pembayaran);
            }

            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $booking->update(['bukti_pembayaran' => $path]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Tidak ada file yang diupload.');
    }

    private function isJadwalBentrok(int $stadionId, string $tanggalSewa, int $slotWaktu): bool
    {
        return PenyewaanStadion::where('stadion_id', $stadionId)
            ->where('tanggal_sewa', $tanggalSewa)
            ->where('slot_waktu', $slotWaktu)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->exists();
    }

    private function hitungWaktuSelesai(string $tanggalSewa, int $slotWaktu, int $durasi): Carbon
    {
        $start = Carbon::parse($tanggalSewa);

        if (!isset(self::SLOT_WAKTU[$slotWaktu])) {
            // default slot pagi
            $slotWaktu = 1;
        }

        $slot = self::SLOT_WAKTU[$slotWaktu];
        [$startTime, $endTime] = [$slot['start'], $slot['end']];

        $start->setTimeFromTimeString($startTime);

        if ($slotWaktu === 3) {
            // full day, durasi * 24 jam
            return $start->copy()->addHours(24 * $durasi);
        } else {
            $batasSelesai = Carbon::parse($tanggalSewa . ' ' . $endTime);
            $end = $start->copy()->addHours($durasi);

            return $end->lessThanOrEqualTo($batasSelesai) ? $end : $batasSelesai;
        }
    }

    public function updateStatus(Request $request, PenyewaanStadion $booking, string $status)
    {
        $allowedStatuses = ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $booking->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    public function lihatJadwal()
{
    // Ambil semua data penyewaan stadion dengan relasi user dan stadion
    $jadwals = PenyewaanStadion::with('stadion', 'user')->get();

    // Tampilkan view khusus untuk user lihat jadwal, pastikan file blade ada di resources/views/penyewaan-stadion/user/lihatjadwal.blade.php
    return view('penyewaan-stadion.user.lihatjadwal', compact('jadwals'));
}
}
