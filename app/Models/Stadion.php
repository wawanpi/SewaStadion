<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- ini yang kurang
use Illuminate\Database\Eloquent\Model;


class Stadion extends Model
{
        use HasFactory;

    protected $table = 'stadion'; // atau 'stadions' jika kamu pakai nama default

    protected $fillable = [
        'nama',
        'lokasi',
        'kapasitas',
        'deskripsi',
        'foto', // kalau kamu upload foto stadion
        'status',  // tambah ini

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
