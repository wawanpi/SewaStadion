<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanStadion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'stadion_id',
        'tanggal_mulai',
        'tanggal_selesai', // <-- Kolom yang hilang sebelumnya
        'waktu_selesai',
        'durasi_hari',
        'durasi_jam',
        'slot_waktu',
        'kondisi',
        'harga',
        'bukti_pembayaran',
        'status',
        'catatan_tambahan',
        'verifikasi',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the stadion that is booked.
     */
    public function stadion()
    {
        return $this->belongsTo(Stadion::class);
    }
}
