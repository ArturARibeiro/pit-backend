<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ZipCode implements CastsAttributes
{
    /**
     * Transforma o valor ao recuperá-lo do modelo.
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (preg_match('/^\d{8}$/', $value)) {
            return substr($value, 0, 5) . '-' . substr($value, 5, 3);
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
