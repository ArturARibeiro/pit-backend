<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $product_id
 * @property string $name
 * @property string $type
 * @property boolean $is_required
 * @property int $max_selections
 * @property Collection<ProductCustomizationOption> $options
 */
class ProductCustomization extends Model
{
    use HasUuids;

    protected $fillable = [
        "id",
        "name",
        "type",
        "is_required",
        "max_selections",
    ];

    protected $casts = [
        "is_required" => "boolean",
    ];

    public function options(): HasMany
    {
        return $this->hasMany(ProductCustomizationOption::class);
    }
}
