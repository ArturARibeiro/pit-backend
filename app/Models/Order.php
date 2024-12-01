<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $user_id
 * @property string $address_id
 * @property string $card_id
 * @property string $status
 * @property int $rate
 * @property string $review
 * @property string $date
 * @property Address $address
 * @property Card $card
 * @property Collection<OrderItem> $items
 */
class Order extends Model
{
    use HasUuids;

    protected $with = ['items', 'address', 'card'];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
