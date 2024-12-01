<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): ProductCollection
    {
        $query = Product::query();

        if ($slug = $request->get('category_slug')) {
            $query->whereHas('categories', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }

        return new ProductCollection($query->get());
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
