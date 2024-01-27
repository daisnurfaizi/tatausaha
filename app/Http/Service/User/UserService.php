<?php

namespace App\Http\Service\User;

use App\Http\Builder\UserEntityBuilder;
use Illuminate\Support\Facades\DB;

// change to your repository
class UserService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createUser($reqesut)
    {

        try {
            DB::beginTransaction();
            $userBuilder = (new UserEntityBuilder)
                ->setName($reqesut->name)
                ->setEmail($reqesut->email)
                ->setPassword($reqesut->password)
                ->build();
            $this->repository->createUser($userBuilder);
            DB::commit();
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User creation failed!');
        }
    }
}
