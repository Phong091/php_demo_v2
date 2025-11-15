<?php

namespace App\Containers\Product\Http\Resources;

use Illuminate\Http\Request;

/**
 * Class ProductDetailResource
 *
 * Resource representation for detailed product view
 */
class ProductDetailResource extends ProductListResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $resource = parent::toArray($request);

        // Add additional fields for detail view
        $resource['description'] = $this->description;
        $resource['deleted_at'] = $this->deleted_at?->format('Y-m-d H:i:s');

        return $resource;
    }
}

