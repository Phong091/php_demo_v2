<?php

namespace App\Containers\User\Services;

use App\Containers\User\Repositories\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    /**
     * Model
     *
     * @return string
     */
    public function repo()
    {
        return UserRepository::class;
    }
}
