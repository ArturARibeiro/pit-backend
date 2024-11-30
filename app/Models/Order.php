<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $user_id
 * @property string $status
 * @property int $rate
 * @property string $review
 * @property string $date
 */
class Order extends Model
{
    use HasUuids;

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
