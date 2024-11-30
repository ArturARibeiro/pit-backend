<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::all());
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
