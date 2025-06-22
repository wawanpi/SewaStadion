<?php

namespace App\Http\Controllers;

use App\Models\HargaSewa;
use App\Models\Stadion;
use Illuminate\Http\Request;

class HargaSewaController extends Controller
{
    // Daftar kondisi yang valid untuk harga sewa
    private $kondisiList = ['pagi-siang', 'siang-sore', 'full-day'];

    // Menampilkan daftar harga sewa dengan relasi stadion, paginasi 10 per halaman
    public function index(Request $request)
    {
        $query = HargaSewa::with('stadion');

        // Fitur pencarian
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->whereHas('stadion', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->orWhere('kondisi', 'like', "%{$search}%")
                ->orWhere('harga', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $harga_sewas = $query->latest()->paginate(10);
        return view('harga-sewa.index', compact('harga_sewas'));
    }

    // Menampilkan form tambah harga sewa
    public function create()
    {
        $stadions = Stadion::all();
        return view('harga-sewa.create', [
            'stadions' => $stadions,
            'kondisiList' => $this->kondisiList, // untuk dropdown kondisi di view
        ]);
    }

    // Menyimpan harga sewa baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'kondisi' => 'required|in:' . implode(',', $this->kondisiList),
            'harga' => 'nullable|numeric|min:0', // boleh kosong, sesuai placeholder di form
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek apakah kombinasi stadion + kondisi sudah ada di database
        $exists = HargaSewa::where('stadion_id', $request->stadion_id)
            ->where('kondisi', $request->kondisi)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['kondisi' => 'Harga untuk kondisi ini di stadion ini sudah tersedia.'])
                ->withInput();
        }

        // Simpan data, jika harga kosong set jadi null
        HargaSewa::create([
            'stadion_id' => $request->stadion_id,
            'kondisi' => $request->kondisi,
            'harga' => $request->harga ?: null,  // null kalau kosong
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('harga-sewa.index')->with('success', 'Harga sewa berhasil ditambahkan.');
    }

    // Menampilkan form edit harga sewa
    public function edit(HargaSewa $harga_sewa)
    {
        $stadions = Stadion::all();
        return view('harga-sewa.edit', [
            'harga_sewa' => $harga_sewa,
            'stadions' => $stadions,
            'kondisiList' => $this->kondisiList,
        ]);
    }

    // Memperbarui harga sewa
    public function update(Request $request, HargaSewa $harga_sewa)
    {
        // Validasi input update
        $request->validate([
            'stadion_id' => 'required|exists:stadion,id',
            'kondisi' => 'required|in:' . implode(',', $this->kondisiList),
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek apakah kombinasi stadion + kondisi sudah ada di database selain record ini
        $exists = HargaSewa::where('stadion_id', $request->stadion_id)
            ->where('kondisi', $request->kondisi)
            ->where('id', '!=', $harga_sewa->id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['kondisi' => 'Harga untuk kondisi ini di stadion ini sudah tersedia.'])
                ->withInput();
        }

        // Update data
        $harga_sewa->update([
            'stadion_id' => $request->stadion_id,
            'kondisi' => $request->kondisi,
            'harga' => $request->harga ?: null,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('harga-sewa.index')->with('success', 'Harga sewa berhasil diperbarui.');
    }

    // Menghapus harga sewa
    public function destroy(HargaSewa $harga_sewa)
    {
        $harga_sewa->delete();
        return redirect()->route('harga-sewa.index')->with('danger', 'Harga sewa berhasil dihapus.');
    }
}
