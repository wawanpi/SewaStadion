<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadion;

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
        ]);

        Stadion::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
            'status' => 0, // Default status "Menunggu"
        ]);

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
        ]);

        $stadion = Stadion::findOrFail($id);
        $stadion->update([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil diupdate');
    }

    // Hapus data stadion
    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);
        $stadion->delete();

        return redirect()->route('stadion.index')->with('success', 'Data stadion berhasil dihapus');
    }

    // Update status stadion (0=Menunggu, 1=Disetujui, 2=Selesai, 3=Ditolak)
    public function updateStatus($id, $status)
    {
        // Validasi status harus integer dan salah satu dari 0,1,2,3
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
