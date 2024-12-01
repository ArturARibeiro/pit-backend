<?php

namespace App\Models;

use App\Casts\ZipCode;
use App\Traits\HasUserIdTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property int $user_id
 * @property string $name
 * @property string $zip_code
 * @property string $state
 * @property string $city
 * @property string $district
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property User $user
 */
class Address extends Model
{
    use HasUuids, HasUserIdTrait;

    protected $casts = [
        'zip_code' => ZipCode::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
