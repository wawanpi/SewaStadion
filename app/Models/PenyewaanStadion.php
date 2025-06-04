<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyewaanStadion extends Model
{
    protected $fillable = [
        'user_id',
        'stadion_id',
        'tanggal_sewa',
        'durasi',
        'catatan_tambahan',
        'bukti_pembayaran',
        'status'
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
