<?php

namespace App\Containers\Product\Http\Controllers\Api;

use App\Containers\Product\Http\Requests\StoreProductRequest;
use App\Containers\Product\Http\Requests\UpdateProductRequest;
use App\Containers\Product\Http\Resources\ProductDetailResource;
use App\Containers\Product\Http\Resources\ProductListResource;
use App\Containers\Product\Services\ProductService;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

/**
 * Class ProductController
 *
 * RESTful API Controller for Product management
 */
class ProductController extends BaseController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * GET /api/v1/products
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 25;
        $data = $this->productService->paginate($perPage);

        return $this->responseSuccess([
            'data' => ProductListResource::collection($data->items()),
            'pagination' => $this->parsePagination($data),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * POST /api/v1/products
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->create($request->validated());

        return $this->responseSuccess([], 201);
    }
    
    /**
     * Display the specified resource.
     *
     * GET /api/v1/products/{id}
     */
    public function show(string $id)
    {
        $data = $this->productService->getById($id);

        return $this->responseSuccess(new ProductDetailResource($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * PUT /api/v1/products/{id}
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $this->productService->updateById($id, $request->validated());

        return $this->responseSuccess(new ProductDetailResource($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * DELETE /api/v1/products/{id}
     */
    public function destroy(string $id)
    {
        $this->productService->deleteById($id);

        return $this->responseSuccess();
    }
}

