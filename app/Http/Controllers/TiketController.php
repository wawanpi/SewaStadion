<?php


// app/Http/Controllers/TiketController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenyewaanStadion;
use PDF; // <- alias dari barryvdh/laravel-dompdf

class TiketController extends Controller
{
    public function downloadTiket($id)
    {
        $penyewaan = PenyewaanStadion::with('stadion', 'user')->findOrFail($id);

        $pdf = PDF::loadView('tiket.pdf', compact('penyewaan'));
        return $pdf->download('tiket_penyewaan_'.$penyewaan->id.'.pdf');
    }
}
