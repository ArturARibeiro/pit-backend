<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $product_id
 * @property integer $quantity
 * @property float $amount
 * @property Product $product
 */
class OrderItem extends Model
{
    use HasUuids;

    protected $with = ['product'];

    protected $casts = [
        'amount' => 'float',
    ];

    protected $fillable = [
        'product_id',
        'quantity',
        'amount',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
