<?php

namespace App\Http\Controllers\Login;

use App\Helper\AplicationHelper;
use App\Helper\Otp;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard.index');
        }
        $aplication = AplicationHelper::getAplication();
        return view('login.login', compact('aplication'));
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
        $user = User::where('email', $request->email)->first();
        $checkotp = Otp::checkOtp($user->id, $request->otp);
        if ($checkotp === false) {
            return redirect()->back()->with('error', 'Invalid OTP');
        }
        if (auth()->attempt($credentials) && $checkotp === true) {
            // check otp
            // dd(Otp::checkOtp(auth()->user()->id, $request->otp));
            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        auth()->logout();
        session()->flush();

        return redirect()->route('login');
    }
}
