<?php

namespace App\Containers\Auth\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class SampleRepository extends BaseRepository
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
