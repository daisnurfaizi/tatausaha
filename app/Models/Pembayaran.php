<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "pembayaran";

    protected $fillable = [
        'id',
        'tagihan_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'sisa_tagihan',
        'bukti_pembayaran',
        'keterangan'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id', 'id');
    }
}
