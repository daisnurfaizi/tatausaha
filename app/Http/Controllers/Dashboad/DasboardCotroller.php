<?php

namespace App\Http\Controllers\Dashboad;

use App\Http\Controllers\Controller;
use App\Http\Repository\User\UserRepository;
use App\Http\Service\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class DasboardCotroller extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->hasRole('admin')) {
                return redirect()->route('dashboard.analitic');
            } elseif ($user->hasRole('Kepala Sekolah')) {
                return redirect()->route('dashboard.analitic');
            } elseif ($user->hasRole('admin spp')) {
                return redirect()->route('dashboard.payment');
            } else {
                // Handle undefined roles, you can redirect to a default dashboard or show an error.
                return redirect()->route('dashboard.index');
            }
        } else {
            // Handle unauthenticated users, you can redirect them to the login page.
            return redirect()->route('login');
        }
    }

    public function datauser()
    {
        return view('User.Datauser');
    }

    public function getDataUsers()
    {
        $userService = new UserService(new UserRepository(new User()));
        return $userService->getDataUsers();
    }

    public function deleteUser($id)
    {
        $userService = new UserService(new UserRepository(new User()));
        return $userService->deleteUser($id);
    }
}
