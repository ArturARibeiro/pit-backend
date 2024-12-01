<?php

namespace App\Models;

use App\Casts\CardNumber;
use App\Traits\HasUserIdTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $number
 * @property string $cvv
 * @property string $validity
 * @property string $type
 * @property User $user
 */
class Card extends Model
{
    use HasUuids, HasUserIdTrait;

    protected $casts = [
        'number' => CardNumber::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
