<?php

namespace App\Services;

use App\Repositories\UserRepository;

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
