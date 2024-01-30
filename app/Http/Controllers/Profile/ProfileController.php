<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Repository\Profile\ProfileRepository;
use App\Http\Service\Profile\ChangePasswordService;
use App\Http\Service\Profile\ProfileService;
use App\Http\Service\User\PhotoService;
use App\Models\User;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $profile = new ProfileService(new ProfileRepository(new User()));
        return $profile->updateProfile($request);
    }

    public function updatePassword(Request $request)
    {
        $profile = new ChangePasswordService(new ProfileRepository(new User()));
        return $profile->changePassword($request);
    }

    public function updatePhoto(Request $request)
    {
        $profile = new PhotoService(new ProfileRepository(new User()));
        return $profile->updatePhoto($request);
    }
}
