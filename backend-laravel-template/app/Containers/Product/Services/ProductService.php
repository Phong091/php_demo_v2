<?php

namespace App\Containers\Product\Services;

use App\Containers\Product\Repositories\ProductRepository;
use App\Services\BaseService;

class ProductService extends BaseService
{
    /**
     * Specify Repository class name
     *
     * @return string
     */
    public function repo()
    {
        return ProductRepository::class;
    }
}

