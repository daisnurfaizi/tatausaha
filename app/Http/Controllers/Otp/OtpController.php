<?php

namespace App\Http\Controllers\Otp;

use App\Helper\ResponseJsonFormater;
use App\Http\Controllers\Controller;
use App\Mail\RequestOtp;
use App\Models\Otp\OtpModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\callback;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate(
                [
                    'email' => 'required|email|exists:users,email'
                ],

                [
                    'email.required' => 'Email Harus diisi',
                    'email.email' => 'Email tidak valid',
                    'email.exists' => 'Email tidak terdaftar'
                ]
            );

            $user = User::where('email', $request->email)->first();
            $otp = rand(100000, 999999);


            $chekOtp = $this->checkOtp($otp, $user->id);

            if (!$chekOtp) {
                // dd($chekOtp);
                $this->saveOtp($otp, $user->id);
                Mail::send(
                    view: 'Otp.index',
                    data: ['otp' => $otp],
                    callback: function ($message) use ($user) {
                        $message->to($user->email);
                        $message->subject('Your One-Time Password (OTP)');
                    }
                );
                return ResponseJsonFormater::success('Otp sent');
            } else {
                return ResponseJsonFormater::error('Otp already sent');
            }
        } catch (\Exception $e) {
            return ResponseJsonFormater::error($e->getMessage());
        }
    }

    public function saveOtp($otp, $user_id)
    {
        $otp = OtpModel::create([
            'user_id' => $user_id,
            'code' => $otp,
            'expires_at' => now()->addMinutes(5)
        ]);
    }

    private function checkOtp($user_id)
    {
        $otp = OtpModel::where('user_id', $user_id)
            ->where('expires_at', '>', now())
            ->exists();

        return $otp;
    }
}
