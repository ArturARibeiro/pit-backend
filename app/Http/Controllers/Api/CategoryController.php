<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function index(): ProductCategoryCollection
    {
        return new ProductCategoryCollection(ProductCategory::all());
    }

    public function show(ProductCategory $category): ProductCategoryResource
    {
        return new ProductCategoryResource($category);
    }
}
