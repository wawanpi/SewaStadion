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
    /**
     * Single Source of Truth untuk semua informasi slot.
     * Semua logika lain akan mengambil data dari sini.
     */
    private const SLOT_WAKTU = [
        1 => ['start' => '06:00', 'end' => '12:00', 'kondisi' => 'pagi-siang', 'durasi' => 6],
        2 => ['start' => '13:00', 'end' => '19:00', 'kondisi' => 'siang-sore', 'durasi' => 6],
        3 => ['start' => '00:00', 'end' => '23:59', 'kondisi' => 'full-day',   'durasi' => 24],
        4 => ['start' => '19:00', 'end' => '23:00', 'kondisi' => 'malam',      'durasi' => 4],
    ];

    public function adminIndex(Request $request)
    {
        // ... (Kode ini sudah benar, tidak perlu diubah) ...
        $query = PenyewaanStadion::with(['stadion:id,nama', 'user:id,name'])
            ->select([
                'id', 'user_id', 'stadion_id', 'tanggal_mulai', 'slot_waktu',
                'waktu_selesai', 'durasi_hari', 'durasi_jam', 'kondisi',
                'harga', 'bukti_pembayaran', 'status', 'catatan_tambahan','verifikasi',
                'created_at'
            ]);
        
        if ($request->has('status') && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        
        $penyewaanStadions = $query->latest()->paginate(10);
        
        $counts = [
            'menunggu' => PenyewaanStadion::where('status', 'Menunggu')->count(),
            'diterima' => PenyewaanStadion::where('status', 'Diterima')->count(),
            'ditolak' => PenyewaanStadion::where('status', 'Ditolak')->count(),
            'selesai' => PenyewaanStadion::where('status', 'Selesai')->count(),
        ];
        
        $pendapatanBulanIni = PenyewaanStadion::where('status', 'Selesai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('harga');
        
        $pendapatanBulanLalu = PenyewaanStadion::where('status', 'Selesai')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('harga');
        
        $perubahanPendapatan = $pendapatanBulanLalu > 0 
            ? (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100
            : ($pendapatanBulanIni > 0 ? 100 : 0);
        
        $pendapatanTahunIni = PenyewaanStadion::where('status', 'Selesai')
            ->whereYear('created_at', now()->year)
            ->sum('harga');
        
        $totalPendapatan = PenyewaanStadion::where('status', 'Selesai')
            ->sum('harga');
        
        return view('penyewaan-stadion.admin.adminindex', [
            'penyewaanStadions' => $penyewaanStadions,
            'counts' => $counts,
            'monthlyRevenue' => $pendapatanBulanIni,
            'revenueChange' => $perubahanPendapatan,
            'pendapatanTahunIni' => $pendapatanTahunIni,
            'totalPendapatan' => $totalPendapatan
        ]);
    }

    public function create(Request $request)
    {
        $stadionId = $request->query('stadion_id');
        
        $stadions = $stadionId 
            ? Stadion::where('id', $stadionId)->get()
            : Stadion::all();

        // Membuat daftar slot secara dinamis dari konstanta
        $slots = [];
        foreach (self::SLOT_WAKTU as $id => $details) {
            $namaSlot = ucfirst(str_replace('-', ' ', $details['kondisi']));
            $slots[$id] = "{$namaSlot} ({$details['start']} - {$details['end']})";
        }

        $bookedDates = PenyewaanStadion::whereIn('status', ['Menunggu', 'Diterima'])
            ->pluck('tanggal_mulai')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();

        return view('penyewaan-stadion.User.BuatPesanan', [
            'stadions' => $stadions,
            'slots' => $slots,
            'bookedDates' => $bookedDates,
            'selectedStadionId' => $stadionId
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'durasi_hari' => [
                'required','integer','min:1',
                function ($attribute, $value, $fail) use ($request) {
                    // Slot selain full-day hanya boleh 1 hari
                    if ($request->slot_waktu != 3 && $value > 1) {
                        $fail('Slot waktu Pagi/Sore/Malam hanya boleh 1 hari.');
                    }
                }
            ],
            'slot_waktu' => 'required|in:' . implode(',', array_keys(self::SLOT_WAKTU)),
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'verifikasi' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan_tambahan' => 'nullable|string|max:255',
        ]);

        // Ambil semua detail slot dari konstanta
        $slotDetails = self::SLOT_WAKTU[$validated['slot_waktu']];
        
        try {
            $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
                ->where('kondisi', $slotDetails['kondisi']) // <- Menggunakan kondisi dari konstanta
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withInput()
                ->withErrors(['slot_waktu' => 'Harga sewa untuk slot waktu ini belum diatur.']);
        }

        if ($hargaSewa->harga <= 0) {
            return redirect()->back()->withInput()
                ->withErrors(['slot_waktu' => 'Harga sewa tidak valid (Rp 0).']);
        }

        // --- BLOK PERBAIKAN LOGIKA TANGGAL ---
        $startDate = Carbon::parse($validated['tanggal_mulai']);
        $durasiHari = $validated['durasi_hari'];

        $waktuMulai = $startDate->copy()->setTimeFromTimeString($slotDetails['start']);
        $waktuSelesai = $startDate->copy()->addDays($durasiHari - 1)->setTimeFromTimeString($slotDetails['end']);
        $tanggalSelesai = $waktuSelesai->toDateString();

        // --- Memasukkan semua data yang sudah dihitung ---
        $validated['tanggal_mulai'] = $waktuMulai;
        $validated['waktu_selesai'] = $waktuSelesai;
        $validated['tanggal_selesai'] = $tanggalSelesai;
        $validated['durasi_jam'] = $durasiHari * $slotDetails['durasi']; // <- Kalkulasi durasi dinamis
        $validated['kondisi'] = $slotDetails['kondisi']; // <- Menggunakan kondisi dari konstanta
        $validated['harga'] = $hargaSewa->harga * $durasiHari;
        $validated['user_id'] = auth()->id();
        
        // Handle file upload
        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }
        if ($request->hasFile('verifikasi')) {
            $validated['verifikasi'] = $request->file('verifikasi')->store('verifikasi_ktp', 'public');
        }

        if ($this->isJadwalBentrok(
            $validated['stadion_id'],
            $validated['tanggal_mulai']->format('Y-m-d'),
            $validated['slot_waktu']
        )) {
            return redirect()->back()->withInput()
                ->withErrors(['tanggal_mulai' => 'Tanggal yang dipilih sudah dipesan.']);
        }

        PenyewaanStadion::create($validated);

        return redirect()->route('penyewaan-stadion.my')
            ->with('success', 'Pemesanan berhasil dibuat. Silakan Menunggu Pesanan Diterima.');
    }

public function myBookings()
    {
        $bookings = PenyewaanStadion::where('user_id', Auth::id())
            ->with('stadion')
            ->orderBy('tanggal_mulai', 'asc') // Urutkan berdasarkan tanggal sewa dari yang paling awal
            ->get();
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
        // Ambil semua booking yang aktif pada tanggal yang diminta
        $existingBookings = PenyewaanStadion::where('stadion_id', $stadionId)
            ->whereDate('tanggal_mulai', '<=', $tanggal)
            ->whereDate('waktu_selesai', '>=', $tanggal)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->get();

        // Jika tidak ada booking sama sekali, pasti tidak bentrok
        if ($existingBookings->isEmpty()) {
            return false;
        }

        // Kasus 1: Kita mau memesan slot Full Day (ID 3)
        if ($slotWaktu == 3) {
            // Jika sudah ada booking APAPUN di hari itu, maka Full Day tidak bisa dipesan.
            return true; 
        }

        // Kasus 2: Kita mau memesan slot Pagi, Sore, atau Malam
        foreach ($existingBookings as $booking) {
            // Jika sudah ada yang pesan Full Day, maka slot lain tidak bisa dipesan.
            if ($booking->slot_waktu == 3) {
                return true;
            }
            // Jika slot yang mau kita pesan sudah dipesan orang lain.
            if ($booking->slot_waktu == $slotWaktu) {
                return true;
            }
        }

        // Jika semua pengecekan lolos, berarti tidak bentrok
        return false;
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
            'slot_waktu' => 'required|in:' . implode(',', array_keys(self::SLOT_WAKTU)),
            'durasi' => 'required|integer|min:1',
        ]);

        $slotDetails = self::SLOT_WAKTU[$validated['slot_waktu']];
        
        $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
            ->where('kondisi', $slotDetails['kondisi'])
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
    public function cancelBooking(PenyewaanStadion $booking)
    {
        // 1. Cek Keamanan: Pastikan yang membatalkan adalah pemilik booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan untuk membatalkan pesanan ini.');
        }

        // 2. Cek Logika: Pastikan status booking masih 'Menunggu'
        if ($booking->status !== 'Menunggu') {
            return redirect()->route('penyewaan-stadion.my')
                ->with('error', 'Pesanan yang sudah diproses tidak bisa dibatalkan.');
        }

        // 3. Ubah status menjadi 'Ditolak' atau hapus bookingnya
        // Pilihan A: Ubah status (direkomendasikan)
        $booking->update(['status' => 'Ditolak']);
        
        // Pilihan B: Hapus permanen (gunakan jika Anda tidak butuh riwayat)
        // $booking->delete();

        return redirect()->route('penyewaan-stadion.my')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
    public function getKetersediaan(Request $request)
    {
        $stadionId = $request->input('stadion_id');
        
        if (!$stadionId) {
            return response()->json(['data' => [],'fully_booked_dates' => [],'partially_booked_dates' => []]);
        }

        $bookings = PenyewaanStadion::where('stadion_id', $stadionId)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->get();

        $data = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->tanggal_mulai);
            $end = Carbon::parse($booking->waktu_selesai);

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $dateStr = $date->toDateString();
                
                if (!isset($data[$dateStr])) {
                    $data[$dateStr] = [
                        'pagi-siang' => false,
                        'siang-sore' => false,
                        'malam' => false,
                        'full-day' => false
                    ];
                }

                $data[$dateStr][$booking->kondisi] = true;

                if ($booking->kondisi === 'full-day') {
                    $data[$dateStr]['pagi-siang'] = true;
                    $data[$dateStr]['siang-sore'] = true;
                    $data[$dateStr]['malam'] = true;
                }
            }
        }

        $fullyBookedDates = [];
        $partiallyBookedDates = [];

        foreach ($data as $date => $slots) {
            if ($slots['full-day'] || ($slots['pagi-siang'] && $slots['siang-sore'] && $slots['malam'])) {
                $fullyBookedDates[] = $date;
                continue;
            }
            
            if ($slots['pagi-siang'] || $slots['siang-sore'] || $slots['malam']) {
                $partiallyBookedDates[] = [
                    'date' => $date,
                    'pagi-siang' => $slots['pagi-siang'],
                    'siang-sore' => $slots['siang-sore'],
                    'malam'      => $slots['malam']
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