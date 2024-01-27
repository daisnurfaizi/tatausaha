<?php

namespace App\Http\Repository\Profile;

use App\Http\Entity\UserEntity;
use App\Http\Repository\BaseRepository;

class ProfileRepository extends BaseRepository
{
    public function __construct($model)
    {
        parent::__construct($model);
    }


    public function updateProfile(UserEntity $entity)
    {
        return $this->updateDetailBy(entity: $entity, method: 'getId', field: 'id');
    }

    public function checkPasswordOld($request)
    {
        $userOldPassword = $this->model->where('id', $request->id)->first();
        return password_verify($request->old_password, $userOldPassword->password);
    }
}
