<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    // soft delete
    use SoftDeletes;
    protected $table = "payments";
    protected $fillable = [
        'nisn',
        'payment_date',
        'month',
        'payment_amount',
        'payment_method',
        'note',
        'payment_file',
        'user',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'nisn', 'nisn');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }
    protected $dates = ['deleted_at'];
}
