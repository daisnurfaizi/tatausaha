<?php

namespace App\Http\Controllers\Login;

use App\Helper\AplicationHelper;
use App\Helper\Otp;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // if (auth()->check()) {
        //     return redirect()->route('dashboard.index');
        // }
        $aplication = AplicationHelper::getAplication();
        return view('login.login', compact('aplication'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email Harus diisi',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password Harus diisi'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        // check otp


        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)
            ->where('status', 'active')
            ->first();
        if (!$user) {
            return redirect()->back()->withInput()->withErrors('Email tidak terdaftar');
        }
        $checkotp = Otp::checkOtp($user->id, $request->otp);
        if ($checkotp === false) {
            return redirect()->back()->withInput()->withErrors('Invalid OTP');
        }
        if (auth()->attempt($credentials) && $checkotp === true) {
            // check otp
            // dd(Otp::checkOtp(auth()->user()->id, $request->otp));
            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->withInput()->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
