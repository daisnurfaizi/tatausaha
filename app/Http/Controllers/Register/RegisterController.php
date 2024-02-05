<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Repository\User\UserRepository;
use App\Http\Service\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $roles = Role::all();
        return view('register.register', compact('roles'));
    }

    public function register(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:255|confirmed'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.min' => 'Nama minimal 3 karakter',
                'name.max' => 'Nama maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 karakter',
                'password.max' => 'Password maksimal 255 karakter',
                'password.confirmed' => 'Password tidak sama dengan konfirmasi password'
            ]
        );

        if ($validation->fails()) {
            return redirect()->route('register')->withErrors($validation)->withInput();
        }

        $user = new UserService(new UserRepository(new User()));

        return $user->createUser($request);
    }
}
