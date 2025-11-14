<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    /**
     * Model
     *
     * @return string
     */
    public function repo()
    {
        return ProductRepository::class;
    }
}
