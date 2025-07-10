<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadion;
use Illuminate\Support\Facades\Storage;

class StadionController extends Controller
{
    // Tampilkan semua data stadion
    public function index(Request $request)
    {
        $query = Stadion::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('lokasi', 'like', "%{$search}%");
        }

        $stadions = $query->latest()->paginate(10); // Sesuaikan jumlah item per halaman
        return view('stadion.index', compact('stadions'));
    }

    // Tampilkan form tambah stadion
    public function create()
    {
        return view('stadion.create');
    }

    // Simpan data stadion baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5120 KB = 5MB
        ]);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            // tidak ada kapasitas dan status
        ];

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('stadion_foto', 'public');
            $data['foto'] = $path;
        }

        Stadion::create($data);

        return redirect()->route('stadion.index')->with('success', 'Stadion berhasil ditambahkan');
    }

    // Tampilkan form edit stadion
    public function edit($id)
    {
        $stadion = Stadion::findOrFail($id);
        return view('stadion.edit', compact('stadion'));
    }

    // Update data stadion
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5120 KB = 5MB
        ]);

        $stadion = Stadion::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            // hapus kapasitas
        ];

        // Handle upload foto baru dan hapus foto lama jika ada
        if ($request->hasFile('foto')) {
            if ($stadion->foto && Storage::disk('public')->exists($stadion->foto)) {
                Storage::disk('public')->delete($stadion->foto);
            }

            $path = $request->file('foto')->store('stadion_foto', 'public');
            $data['foto'] = $path;
        }

        $stadion->update($data);

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil diupdate');
    }

    // Hapus data stadion
    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);

        if ($stadion->foto && Storage::disk('public')->exists($stadion->foto)) {
            Storage::disk('public')->delete($stadion->foto);
        }

        $stadion->delete();

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil dihapus');
    }

    public function showDashboard(Request $request)
    {
        $query = Stadion::query();

        if ($search = $request->input('search')) {
            $query->where('nama', 'like', "%{$search}%");
        }

        $stadions = $query->latest()->paginate(6); // gunakan paginate agar bisa gunakan links()

        return view('dashboard', compact('stadions'));
    }


}
