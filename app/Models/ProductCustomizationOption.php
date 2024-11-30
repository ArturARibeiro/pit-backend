<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property double $price_modifier
 */
class ProductCustomizationOption extends Model
{
    use HasUuids;

    protected $casts = [
        'price_modifier' => 'double',
    ];
}
