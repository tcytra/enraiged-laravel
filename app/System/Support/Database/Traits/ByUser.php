<?php

namespace App\System\Support\Database\Traits;

trait ByUser
{
    /**
     *  @param  User  $user
     *  @return object|null
     */
    private function byUser($user): ?object
    {
        $model = config('auth.providers.users.model');

        if ($user && $user instanceof $model) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }

        return null;
    }
}
