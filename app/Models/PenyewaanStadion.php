<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanStadion extends Model
{
    protected $fillable = [
        'user_id',
        'stadion_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',                   // ✅ Tambahkan baris ini
        'slot_waktu',               // ✅ Juga tambahkan jika ingin tersimpan
        'kondisi',
        'catatan_tambahan',
        'bukti_pembayaran',
        'status',
        'harga',
        'waktu_selesai',
        
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stadion()
    {
        return $this->belongsTo(Stadion::class);
    }
}
