<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $table = "cicilan";

    protected $fillable = [
        'id',
        'tagihan_id',
        'tanggal_cicilan',
        'jumlah_cicilan',
        'bukti_cicilan',
    ];
}
