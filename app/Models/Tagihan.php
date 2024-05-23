<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = "tagihan";

    protected $fillable = [
        'id',
        'student_id',
        'bulan_tagihan',
        'tahun_tagihan',
        'jumlah_tagihan',
        'sisa_tagihan',
        'status_tagihan',
        'keterangan',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id')->withTrashed();
    }
}
