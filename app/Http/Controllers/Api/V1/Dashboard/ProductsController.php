<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends BaseController
{

    public function index(): AnonymousResourceCollection
    {
        $query = Product::with(['category'])->paginate(12);

        return ProductResource::collection($query);
    }

    public function store(ProductRequest $request): ProductResource
    {
        $product = Product::create($request->validated());

        return new ProductResource($product->load('category'));
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product->load('category'));
    }

    public function update(ProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());

        return new ProductResource($product->fresh()->load('category'));
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return $this->sendSuccess(__('Product deleted successfully.'));
    }
}
