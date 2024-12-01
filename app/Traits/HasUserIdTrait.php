<?php

namespace App\Traits;

use App\Models\Scopes\UserScope;

/**
 * @property string $user_id
 */
trait HasUserIdTrait
{
    public static function bootHasUserTrait(): void
    {
        self::addGlobalScope(new UserScope);
    }
}
