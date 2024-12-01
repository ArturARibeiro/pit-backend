<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCustomization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data');

        $categories = File::json("$path/categories.json");
        ProductCategory::query()->insert($categories);

        $products = File::json("$path/products.json");
        foreach ($products as $product) {
            $customizations = $product['customizations'] ?? [];
            $categories = $product['categories'] ?? [];

            $product = Product::query()->create([
                "sku" => $product["sku"],
                "name" => $product["name"],
                "picture" => $product["picture"],
                "base_price" => $product["base_price"],
                "promotion_price" => $product["promotion_price"] ?? null,
                "description" => $product["description"],
                "rating" => $product["rating"],
                "unit" => $product["unit"],
                "order_count" => $product["order_count"],
                "quantity_gap" => $product["quantity_gap"] ?? 1,
                "tags" => json_encode($product["tags"]),
            ]);

            $product->categories()->sync($categories);

            foreach ($customizations as $customization) {
                $options = $customization['options'] ?? [];

                /** @var ProductCustomization $customization */
                $customization = $product->customizations()->create([
                    "name" => $customization["name"],
                    "type" => $customization["type"],
                    "is_required" => $customization["is_required"],
                ]);

                foreach ($options as $option) {
                    $customization->options()->create([
                        "name" => $option["name"],
                        "price_modifier" => $option["price_modifier"],
                    ]);
                }
            }
        }
    }
}
