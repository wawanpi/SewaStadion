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
    // Mendefinisikan slot waktu penyewaan dengan jam mulai dan jam selesai
    private const SLOT_WAKTU = [
        1 => ['start' => '06:00', 'end' => '12:00'], // Pagi
        2 => ['start' => '13:00', 'end' => '18:00'], // Sore
        3 => ['start' => '00:00', 'end' => '23:59'], // Full day (24 jam)
    ];

    // Menampilkan semua data penyewaan stadion untuk admin (terbaru di atas)
    public function index()
    {
        $penyewaanStadions = PenyewaanStadion::with(['stadion', 'user'])->latest()->get();
        return view('penyewaan-stadion.admin.adminindex', compact('penyewaanStadions'));
    }

    // Menampilkan form pembuatan pesanan baru untuk user
    public function create()
    {
        $stadions = Stadion::all();
        $slots = [
            1 => 'Pagi (06:00 - 12:00)',
            2 => 'Sore (13:00 - 18:00)',
            3 => 'Full Day (06:00 - 18:00)',
        ];
        return view('penyewaan-stadion.User.BuatPesanan', compact('stadions', 'slots'));
    }

    // Menyimpan data penyewaan stadion yang diajukan user
    public function store(Request $request)
    {
        // Validasi input form penyewaan
        $validated = $validated = $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'durasi_hari' => 'required|integer|min:1',
            'slot_waktu' => 'required|in:1,2,3',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'catatan_tambahan' => 'nullable|string|max:255',

        ]);


        // Mapping slot waktu ke kondisi harga sewa
        $kondisiMapping = [
            1 => 'pagi-siang',
            2 => 'siang-sore',
            3 => 'full-day',
        ];

        $kondisi = $kondisiMapping[$validated['slot_waktu']] ?? null;

        // Validasi kondisi slot waktu
        if (!$kondisi) {
            return back()->withInput()->withErrors(['slot_waktu' => 'Slot waktu tidak valid.']);
        }

        $durasiHari = $validated['durasi_hari'] ?? 1;

        // Validasi khusus: slot pagi dan sore hanya boleh durasi 1 hari
        if (in_array($validated['slot_waktu'], [1, 2]) && $durasiHari > 1) {
            return back()->withInput()->withErrors([
                'durasi' => 'Slot waktu Pagi atau Sore hanya boleh dipilih untuk 1 hari.'
            ]);
        }

        // Ambil harga sewa dari tabel harga_sewa sesuai stadion dan kondisi slot
        $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
            ->where('kondisi', $kondisi)
            ->first();

        if (!$hargaSewa || !$hargaSewa->harga) {
            return back()->withInput()->withErrors(['harga' => 'Harga sewa belum tersedia untuk kondisi ini.']);
        }
        // Hitung total harga untuk seluruh durasi
        $totalHarga = $hargaSewa->harga * $durasiHari;
        // Cek apakah jadwal bentrok dengan penyewaan lain selama durasi hari yang dipilih
        for ($i = 0; $i < $durasiHari; $i++) {
            $tanggal = Carbon::parse($validated['tanggal_mulai'])->addDays($i)->toDateString();

            if ($this->isJadwalBentrok($validated['stadion_id'], $tanggal, $validated['slot_waktu'])) {
                return back()->withInput()->withErrors([
                    'tanggal_sewa' => "Jadwal untuk tanggal $tanggal dan slot waktu ini sudah dipesan."
                ]);
            }
        }

        // Simpan data penyewaan per hari selama durasi yang dipilih
        for ($i = 0; $i < $durasiHari; $i++) {
            $tanggal = Carbon::parse($validated['tanggal_mulai'])->addDays($i)->toDateString();

            // Hitung waktu selesai dan durasi dalam jam untuk hari ini
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
                'status' => 'Menunggu', // Status awal adalah menunggu konfirmasi admin
                'catatan_tambahan' => $validated['catatan_tambahan'] ?? null,
                'waktu_selesai' => $waktuSelesai,
            ];

            // Simpan file bukti pembayaran jika ada
            if ($request->hasFile('bukti_pembayaran')) {
                $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            PenyewaanStadion::create($data);
        }

        // Redirect ke halaman booking user dengan pesan sukses
        return redirect()->route('penyewaan-stadion.my')->with('success', 'Booking berhasil dibuat untuk ' . $durasiHari . ' hari.');
    }

    // Menampilkan data penyewaan yang dibuat oleh user yang sedang login
    public function myBookings()
    {
        $bookings = PenyewaanStadion::where('user_id', Auth::id())->with('stadion')->latest()->get();
        return view('penyewaan-stadion.User.my_bookings', compact('bookings'));
    }

    // Fungsi untuk menyetujui booking oleh admin
    public function approve(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Diterima']);
        return back()->with('success', 'Booking disetujui.');
    }

    // Fungsi untuk menolak booking oleh admin
    public function reject(PenyewaanStadion $booking)
    {
        $booking->update(['status' => 'Ditolak']);
        return back()->with('success', 'Booking ditolak.');
    }

    // Fungsi untuk upload bukti pembayaran oleh user
    public function uploadBuktiPembayaran(Request $request, PenyewaanStadion $booking)
    {
        // Validasi file yang diupload
        $validated = $validated = $validated = $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ]);

        // Pastikan yang upload adalah user pemilik booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($booking->bukti_pembayaran && Storage::disk('public')->exists($booking->bukti_pembayaran)) {
                Storage::disk('public')->delete($booking->bukti_pembayaran);
            }

            // Simpan file baru dan update path di database
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $booking->update(['bukti_pembayaran' => $path]);

            return back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }

    // Fungsi private untuk cek apakah jadwal penyewaan bentrok dengan yang sudah ada
    private function isJadwalBentrok(int $stadionId, string $tanggal, int $slotWaktu): bool
    {
        return PenyewaanStadion::where('stadion_id', $stadionId)
            ->where('tanggal_mulai', $tanggal)
            ->where('slot_waktu', $slotWaktu)
            ->whereIn('status', ['Menunggu', 'Diterima']) // Cek status yang belum selesai
            ->exists();
    }

    // Fungsi private untuk menghitung waktu selesai penyewaan berdasarkan slot dan durasi jam
    private function hitungWaktuSelesai(string $tanggal, int $slotWaktu, int $durasi): Carbon
    {
        $start = Carbon::parse($tanggal);

        if (!isset(self::SLOT_WAKTU[$slotWaktu])) {
            $slotWaktu = 1; // Default ke slot pagi jika slot tidak valid
        }

        $slot = self::SLOT_WAKTU[$slotWaktu];
        $start->setTimeFromTimeString($slot['start']); // Set waktu mulai sesuai slot

        $batasSelesai = Carbon::parse($tanggal . ' ' . $slot['end']); // Jam akhir slot
        $end = $start->copy()->addHours($durasi); // Tambah durasi ke waktu mulai

        // Jika durasi melebihi batas slot, batasi sampai akhir slot
        return $end->lessThanOrEqualTo($batasSelesai) ? $end : $batasSelesai;
    }

    // Fungsi private untuk menghitung durasi sewa dalam jam berdasarkan waktu mulai dan selesai
    private function hitungDurasiSewa(string $tanggal, int $slotWaktu, string $waktuSelesai): int
    {
        if (!isset(self::SLOT_WAKTU[$slotWaktu])) {
            return 0;
        }

        $slot = self::SLOT_WAKTU[$slotWaktu];
        $start = Carbon::parse($tanggal . ' ' . $slot['start']);
        $end = Carbon::parse($waktuSelesai);
        $durasiJam = $end->diffInHours($start);

        return max(1, ceil($durasiJam)); // Minimal durasi 1 jam, pembulatan ke atas
    }

    // Update status penyewaan (Menunggu, Diterima, Ditolak, Selesai)
    public function updateStatus(Request $request, PenyewaanStadion $booking, string $status)
    {
        $allowedStatuses = ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return back()->with('error', 'Status tidak valid.');
        }

        $booking->update(['status' => $status]);

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    // Menampilkan jadwal penyewaan untuk user
    public function lihatJadwal()
    {
        $jadwals = PenyewaanStadion::with('stadion', 'user')->get();
        return view('penyewaan-stadion.User.LihatJadwal', compact('jadwals'));
    }

    // Tandai penyewaan sudah selesai oleh admin/user
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

    // API untuk menghitung total harga berdasarkan stadion, slot, dan durasi sewa
    public function hitungHargaTotal(Request $request)
    {
        $validated = $validated = $validated = $validated = $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'slot_waktu' => 'required|in:1,2,3',
            'durasi' => 'required|integer|min:1',
        ]);

        $kondisiMapping = [
            1 => 'pagi-siang',
            2 => 'siang-sore',
            3 => 'full-day',
        ];

        $kondisi = $kondisiMapping[$validated['slot_waktu']];

        $hargaSewa = HargaSewa::where('stadion_id', $validated['stadion_id'])
            ->where('kondisi', $kondisi)
            ->first();

        if (!$hargaSewa) {
            return response()->json(['error' => 'Harga sewa tidak ditemukan.'], 404);
        }

        // Hitung total harga = harga per hari dikali durasi hari
        $totalHarga = $hargaSewa->harga * $validated['durasi'];

        return response()->json([
            'total_harga' => $totalHarga,
            'harga_per_hari' => $hargaSewa->harga,
            'durasi' => $validated['durasi'],
        ]);
    }
    //Pembayaran
    public function showPembayaran()
    {
        $booking = PenyewaanStadion::where('user_id', Auth::id())
            ->where('status', 'Diterima')
            ->whereNull('bukti_pembayaran') // hanya yang belum upload bukti
            ->latest()
            ->first();

        return view('penyewaan-stadion.User.Pembayaran', compact('booking'));
    }
    

}
