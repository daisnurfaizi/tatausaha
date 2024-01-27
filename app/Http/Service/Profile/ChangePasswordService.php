<?php

namespace App\Http\Service\Profile;

use App\Http\Builder\UserEntityBuilder;
use App\Http\Repository\BaseRepository;
use Illuminate\Support\Facades\Validator;

// change to your repository
class ChangePasswordService extends BaseRepository
{

    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function changePassword($request)
    {
        try {
            $this->validateRequest($request);
            $passwordBuilder = (new UserEntityBuilder)
                ->setPassword($request->password)
                ->setId($request->id)
                ->build();
            $checkPasswordOld = $this->repository->checkPasswordOld($request);
            if (!$checkPasswordOld) {
                throw new \Exception('Password lama tidak sesuai');
            }
            $this->repository->updateProfile($passwordBuilder);
            return redirect()->route('profile.profile')->with('success', 'Password berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('profile.profile')->withErrors($e->getMessage());
        }
    }

    private function validateRequest($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'password' => 'required',
                'old_password' => 'required',
                'password_confirmation' => 'required|same:password'
            ]
        );

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
