<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $product_id
 * @property integer $quantity
 * @property float $price
 * @property Product $product
 */
class OrderItem extends Model
{
    //

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
