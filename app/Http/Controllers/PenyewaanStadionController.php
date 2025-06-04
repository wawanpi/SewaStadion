<?php

namespace App\Http\Controllers;

use App\Models\PenyewaanStadion;
use App\Models\Stadion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'catatan_tambahan' => 'nullable|string',
            'bukti_pembayaran' => 'nullable|mimes:jpg,jpeg,png,gif,webp,pdf|max:5120',
        ], [
            'tanggal_sewa.after_or_equal' => 'Tanggal sewa harus hari ini atau setelahnya.',
            'bukti_pembayaran.mimes' => 'File bukti pembayaran harus berupa gambar atau PDF.',
            'bukti_pembayaran.max' => 'Ukuran file tidak boleh melebihi 5 MB.', // Tambahkan ini

        ]);


        $data = $request->only(['stadion_id', 'tanggal_sewa', 'durasi', 'catatan_tambahan']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'Menunggu';

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $data['bukti_pembayaran'] = $path;
        }

        PenyewaanStadion::create($data);

        return redirect()->route('penyewaan-stadion.my')->with('success', 'Booking berhasil dibuat, silakan tunggu persetujuan admin.');
        // Pastikan route 'penyewaan_stadion.my' ada dan mengarah ke myBookings()
    }

    // Tampilkan daftar booking user yang login
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = PenyewaanStadion::where('user_id', $user->id)
            ->with('stadion')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('penyewaan-stadion.my_bookings', compact('bookings')); // pastikan view ini ada
    }

    // Halaman admin lihat semua booking
    public function adminIndex()
    {
        $penyewaanStadions = PenyewaanStadion::with(['user', 'stadion'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bookings.index', compact('penyewaanStadions')); // sesuaikan dengan nama view dan variabel
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
}
