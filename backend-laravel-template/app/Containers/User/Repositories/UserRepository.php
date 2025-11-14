<?php

namespace App\Containers\User\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
