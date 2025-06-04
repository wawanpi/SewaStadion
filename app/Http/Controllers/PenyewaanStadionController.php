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
    public function index()
    {
        $penyewaanStadions = PenyewaanStadion::with('stadion', 'user')->get();

        return view('penyewaan-stadion.index', compact('penyewaanStadions'));
    }

    // Tampilkan form booking untuk stadion tertentu
    public function create()
    {
        $stadion = Stadion::all(); // ambil semua stadion
        return view('penyewaan-stadion.create', compact('stadion'));
    }

    // Simpan data booking baru
    public function store(Request $request)
    {
        $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'tanggal_sewa' => 'required|date|after_or_equal:today',
            'durasi' => 'required|integer|min:1',
            'slot_waktu' => 'required|in:1,2,3',
            'catatan_tambahan' => 'nullable|string',
            'bukti_pembayaran' => 'nullable|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ], [
            'tanggal_sewa.after_or_equal' => 'Tanggal sewa harus hari ini atau setelahnya.',
            'bukti_pembayaran.mimes' => 'File bukti pembayaran harus berupa gambar atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran file tidak boleh melebihi 5 MB.',
            'slot_waktu.in' => 'Slot waktu tidak valid.',
        ]);

        // Cek jadwal bentrok
        if ($this->isJadwalBentrok($request->stadion_id, $request->tanggal_sewa, $request->slot_waktu)) {
            return redirect()->back()->withInput()->withErrors(['tanggal_sewa' => 'Jadwal untuk stadion dan slot waktu ini sudah dipesan.']);
        }

        $data = $request->only(['stadion_id', 'tanggal_sewa', 'durasi', 'catatan_tambahan', 'slot_waktu']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'Menunggu';

        // Hitung waktu_selesai berdasarkan slot_waktu dan durasi
        $data['waktu_selesai'] = $this->hitungWaktuSelesai($data['tanggal_sewa'], $data['slot_waktu'], $data['durasi']);

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $data['bukti_pembayaran'] = $path;
        }

        PenyewaanStadion::create($data);

        return redirect()->route('penyewaan-stadion.my')->with('success', 'Booking berhasil dibuat, silakan tunggu persetujuan admin.');
    }

    // Tampilkan daftar booking user yang login
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = PenyewaanStadion::where('user_id', $user->id)
            ->with('stadion')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewaan-stadion.my_bookings', compact('bookings'));
    }

    // Halaman admin lihat semua booking
    public function adminIndex()
    {
        $penyewaanStadions = PenyewaanStadion::with(['user', 'stadion'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.index', compact('penyewaanStadions'));
    }

    // Admin setujui booking
    public function approve(PenyewaanStadion $booking)
    {
        $booking->status = 'Diterima';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil disetujui.');
    }

    // Admin tolak booking
    public function reject(PenyewaanStadion $booking)
    {
        $booking->status = 'Ditolak';
        $booking->save();

        return redirect()->back()->with('success', 'Booking berhasil ditolak.');
    }

    // Upload ulang bukti pembayaran user
    public function uploadBuktiPembayaran(Request $request, PenyewaanStadion $booking)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'bukti_pembayaran.mimes' => 'File harus berupa gambar atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 5MB.',
        ]);

        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->hasFile('bukti_pembayaran')) {
            if ($booking->bukti_pembayaran) {
                Storage::disk('public')->delete($booking->bukti_pembayaran);
            }

            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $booking->bukti_pembayaran = $path;
            $booking->save();

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Tidak ada file yang diupload.');
    }

    // Fungsi private untuk cek jadwal bentrok
    private function isJadwalBentrok($stadionId, $tanggalSewa, $slotWaktu)
    {
        return PenyewaanStadion::where('stadion_id', $stadionId)
            ->where('tanggal_sewa', $tanggalSewa)
            ->where('slot_waktu', $slotWaktu)
            ->whereIn('status', ['Menunggu', 'Diterima'])
            ->exists();
    }

    // Fungsi private untuk hitung waktu selesai berdasarkan slot_waktu dan durasi
    private function hitungWaktuSelesai($tanggalSewa, $slotWaktu, $durasi)
    {
        $start = Carbon::parse($tanggalSewa);

        switch ($slotWaktu) {
            case 1: // pagi sampai siang (6:00 - 12:00)
                $start->setTime(6, 0, 0);
                $jamSelesai = 12;
                break;
            case 2: // siang sampai sore (13:00 - 18:00)
                $start->setTime(13, 0, 0);
                $jamSelesai = 18;
                break;
            case 3: // full day (24 jam)
                $start->setTime(0, 0, 0);
                $jamSelesai = 24;
                break;
            default:
                $start->setTime(6, 0, 0);
                $jamSelesai = 12;
        }

        if ($slotWaktu == 3) {
            // full day, durasi 1 = 24 jam, durasi 2 = 48 jam, dst
            return $start->copy()->addHours(24 * $durasi);
        } else {
            $end = $start->copy()->addHours($durasi);
            $batasSelesai = $start->copy()->setTime($jamSelesai, 0, 0);
            if ($end->greaterThan($batasSelesai)) {
                $end = $batasSelesai;
            }
            return $end;
        }
    }

    // Tambahan: Update status booking (Admin)
    public function updateStatus(Request $request, PenyewaanStadion $booking, $status)
    {
        $allowedStatuses = ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'];

        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('danger', 'Status tidak valid.');
        }

        $booking->status = $status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
