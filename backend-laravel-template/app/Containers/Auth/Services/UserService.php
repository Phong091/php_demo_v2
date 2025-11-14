<?php

namespace App\Containers\Auth\Services;

use App\Repositories\UserRepository;
use App\Services\BaseService;

class SampleService extends BaseService
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
