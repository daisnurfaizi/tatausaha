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
        return view('dashboard.index');
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
