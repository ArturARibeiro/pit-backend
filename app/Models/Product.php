<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $sku
 * @property string $name
 * @property string $picture
 * @property float $base_price
 * @property float $promotion_price
 * @property string $description
 * @property float $rating
 * @property string $unit
 * @property int $order_count
 * @property float $quantity_gap
 * @property string $tags
 * @property Collection<ProductCategory> $categories
 * @property Collection<ProductCustomization> $customizations
 */
class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        "sku",
        "name",
        "picture",
        "base_price",
        "promotion_price",
        "description",
        "rating",
        "unit",
        "order_count",
        "quantity_gap",
        "tags",
    ];

    protected $casts = [
        "promotion_price" => "double",
        "base_price" => "double",
        "quantity_gap" => "double",
        "tags" => "array",
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function customizations(): HasMany
    {
        return $this->hasMany(ProductCustomization::class);
    }
}
