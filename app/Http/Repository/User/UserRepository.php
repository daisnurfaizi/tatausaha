<?php

namespace App\Http\Repository\User;

use App\Http\Entity\UserEntity;
use App\Http\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }

    public function createUser(UserEntity $request)
    {
        return $this->createByEntity($request);
    }
}
