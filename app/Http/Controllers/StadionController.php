<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadion;
use Illuminate\Support\Facades\Storage;

class StadionController extends Controller
{
    // Tampilkan semua data stadion
    public function index()
    {
        $stadions = Stadion::all();
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
            'kapasitas' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'status' => 0, // Default status "Menunggu"
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
            'kapasitas' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $stadion = Stadion::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
        ];

        // Handle upload foto baru dan hapus foto lama jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
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

        // Hapus file foto jika ada
        if ($stadion->foto && Storage::disk('public')->exists($stadion->foto)) {
            Storage::disk('public')->delete($stadion->foto);
        }

        $stadion->delete();

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil dihapus');
    }

    // Update status stadion (0=Menunggu, 1=Disetujui, 2=Selesai, 3=Ditolak)
    public function updateStatus($id, $status)
    {
        $validStatus = [0, 1, 2, 3];

        if (!in_array((int)$status, $validStatus, true)) {
            return redirect()->back()->with('danger', 'Status tidak valid');
        }

        $stadion = Stadion::findOrFail($id);
        $stadion->status = (int)$status;
        $stadion->save();

        $messages = [
            0 => 'Status diubah menjadi Menunggu',
            1 => 'Status diubah menjadi Disetujui',
            2 => 'Status diubah menjadi Selesai',
            3 => 'Status diubah menjadi Ditolak',
        ];

        return redirect()->route('stadion.index')->with('success', $messages[$status]);
    }
}
