<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $searchableFields = [
        'id' => ['field' => 'id', 'operator' => '='],
        'name' => ['field' => 'name', 'operator' => 'like'],
        'ids' => ['field' => 'id', 'operator' => 'in'],
    ];

    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }
}
