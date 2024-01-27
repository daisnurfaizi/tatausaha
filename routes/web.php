<?php

use App\Http\Controllers\Dashboad\DasboardCotroller;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Otp\OtpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login.login');
});

Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ],
    function () {
        Route::controller(DasboardCotroller::class)->group(
            function () {
                Route::get('home', 'index')->name('index');
            }
        );
    }
);

Route::controller(LoginController::class)->group(
    function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    }
);
// register
Route::controller(RegisterController::class)->middleware('auth')->group(
    function () {
        Route::get('register', 'showRegisterForm')->name('register');
        Route::post('register', 'register')->name('register');
    }
);



// Lupa Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Request OTP
Route::post('send-otp', [OtpController::class, 'sendOtp'])->name('password.otp');
