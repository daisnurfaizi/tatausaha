<?php

namespace App\Http\Service\Profile;

use App\Http\Builder\UserEntityBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// change to your repository
class ProfileService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }


    public function updateProfile($request)
    {
        try {
            $this->validateRequest($request);
            DB::beginTransaction();
            $userBuilder = (new UserEntityBuilder)
                ->setName($request->name)
                ->setEmail($request->email)
                ->setAddress($request->address)
                ->setPhone($request->phone)
                ->setId($request->id)
                ->build();
            $this->repository->updateProfile($userBuilder);
            DB::commit();
            return redirect()->route('profile.profile')->with('success', 'Profile berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profile.profile')->withErrors($e->getMessage());
        }
    }

    protected function validateRequest($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'sometimes',
                'phone' => 'sometimes|numeric'
            ]
        );

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
