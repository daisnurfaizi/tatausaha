<?php

namespace App\Models\Otp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpModel extends Model
{
    use HasFactory;

    protected $table = 'otp_codes';

    protected $fillable = [
        'user_id',
        'code',
        'expires_at'
    ];
}
