<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
    protected $fillable = [
        'student_id',
        'payment_date',
        'month',
        'payment_amount',
        'payment_method',
        'note'
    ];
}
