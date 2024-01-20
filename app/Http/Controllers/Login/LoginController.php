<?php

namespace App\Http\Controllers\Login;

use App\Helper\Otp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
                'otp' => 'required'
            ]
        );

        // check otp


        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // check otp
            // dd(Otp::checkOtp(auth()->user()->id, $request->otp));
            if (Otp::checkOtp(auth()->user()->id, $request->otp)) {
                return redirect()->route('dashboard.index');
            }
            return redirect()->route('login')->with('error', 'Invalid otp');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
