<?php

use App\Http\Controllers\Dashboad\DasboardCotroller;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Otp\OtpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Student\StudentController;

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
        'middleware' => ['auth'],
        'prefix' => 'dashboard',
        'as' => 'dashboard.'
    ],
    function () {
        Route::controller(DasboardCotroller::class)->group(
            function () {
                Route::get('home', 'index')->name('index');
                Route::get('datauser', 'datauser')->name('datauser');
                Route::get('getdatauser', 'getDataUsers')->name('getdatauser');
                Route::get('deleteuser/{id}', 'deleteUser')->name('deleteuser');
            }
        );
        Route::controller(StudentController::class)->group(
            function () {
                Route::get('student', 'index')->name('student');
                Route::get('getdatastudent', 'getDataStudent')->name('getdatastudent');
                Route::get('addstudent', 'addStudent')->name('addstudent');
                Route::post('savestudent', 'saveStudent')->name('savestudent');
                Route::get('editstudent/{id}', 'editStudent')->name('editstudent');
                Route::post('updatestudent', 'updateStudent')->name('updatestudent');
                Route::get('deletestudent/{id}', 'deleteStudent')->name('deletestudent');
                Route::get('studentExport', 'studentExport')->name('studentExport');
                Route::post('studentImport', 'studentImport')->name('studentImport');
                Route::get('studentTemplate', 'studentTemplate')->name('studentTemplate');
            }
        );

        Route::controller(PaymentController::class)->group(
            function () {
                Route::get('payment', 'index')->name('payment');
                Route::get('getdatapayment', 'getDataPayment')->name('getdatapayment');
                Route::post('addpayment', 'addPayment')->name('addpayment');
                Route::get('getDataPayment', 'getDataPayment')->name('getDataPayment');
                Route::get('getDataPayment/{id}', 'getDataPaymentByID')->name('getDataPaymentByID');
                Route::get('editpayment/{id}', 'editPayment')->name('editpayment');
                Route::post('updatepayment', 'updatePayment')->name('updatepayment');
                Route::get('deletepayment/{id}', 'deletePayment')->name('deletepayment');
                Route::get('paymentExport', 'paymentExport')->name('paymentExport');
                Route::post('paymentImport', 'paymentImport')->name('paymentImport');
                Route::get('paymentTemplate', 'paymentTemplate')->name('paymentTemplate');
            }
        );
    }
);
// profile
Route::group(
    [
        'middleware' => 'auth',
        'prefix' => 'profile',
        'as' => 'profile.'
    ],
    function () {
        Route::controller(ProfileController::class)->group(
            function () {
                // Route::get('profile', 'index')->name('index');
                Route::get('profile', 'profile')->name('profile');
                Route::post('updateProfile', 'updateProfile')->name('updateProfile');
                Route::post('updatePassword', 'updatePassword')->name('updatePassword');
                Route::post('updatePhoto', 'updatePhoto')->name('updatePhoto');
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
