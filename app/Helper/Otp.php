<?php

namespace App\Helper;

use App\Models\Otp\OtpModel;

class Otp
{
    public static function checkOtp($user_id, $otp)
    {
        $otp = OtpModel::where('user_id', $user_id)
            ->where('code', $otp)
            ->where('expires_at', '>', now())
            ->exists();

        return $otp;
    }
}
