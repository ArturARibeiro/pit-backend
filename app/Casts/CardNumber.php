<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CardNumber implements CastsAttributes
{
    /**
     * Transforma o valor ao recuperá-lo do modelo.
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (strlen($value) === 16) {
            return substr($value, 0, 4) . ' **** **** ' . substr($value, -4);
        }

        return $value;
    }

    /**
     * Transforma o valor ao defini-lo no modelo.
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return preg_replace('/\D/', '', $value);
    }
}
