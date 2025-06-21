<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanStadion extends Model
{
    protected $fillable = [
        'user_id',
        'stadion_id',
        'tanggal_mulai',
        'durasi_hari', // tambahkan ini
        'durasi_jam',  // tambahkan ini
        'slot_waktu',
        'kondisi',
        'harga',
        'bukti_pembayaran',
        'status',
        'catatan_tambahan',
        'waktu_selesai'
    ];

    // Accessor untuk kondisi
    public function getKondisiAttribute()
    {
        return [
            1 => 'pagi-siang',
            2 => 'siang-sore',
            3 => 'full-day'
        ][$this->slot_waktu];
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stadion()
    {
        return $this->belongsTo(Stadion::class);
    }
}