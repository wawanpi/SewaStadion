<?php

// app/Models/HargaSewa.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSewa extends Model
{
    use HasFactory;

    protected $table = 'harga_sewa';

    protected $fillable = [
        'stadion_id',
        'kondisi',
        'harga',
        'keterangan', // ✅ tambahkan ini
    ];


    public function stadion()
    {
        return $this->belongsTo(Stadion::class);
    }
}
