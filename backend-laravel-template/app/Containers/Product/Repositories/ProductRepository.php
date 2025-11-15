<?php

namespace App\Containers\Product\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    /**
     * Define searchable fields for filtering
     *
     * @var array
     */
    protected $searchableFields = [
        'id' => ['field' => 'id', 'operator' => '='],
        'name' => ['field' => 'name', 'operator' => 'like'],
        'category' => ['field' => 'category', 'operator' => '='],
        'status' => ['field' => 'status', 'operator' => '='],
        'ids' => ['field' => 'id', 'operator' => 'in'],
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }
}

