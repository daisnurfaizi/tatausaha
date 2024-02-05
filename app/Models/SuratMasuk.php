<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'id',
        'nomor_surat',
        'tanggal_terima',
        'pengirim',
        'perihal',
        'keterangan',
        'lampiran'
    ];
}
