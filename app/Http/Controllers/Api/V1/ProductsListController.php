<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsListController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $query = Product::with(['category'])->paginate(12);

        return ProductResource::collection($query);
    }
}
