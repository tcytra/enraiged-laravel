<?php

namespace Enraiged\Support\Database\Traits;

trait ByUser
{
    /**
     *  @param  User  $model
     *  @return object|null
     */
    private function byUser($model): ?object
    {
        $auth_model = config('auth.providers.users.model');

        if ($model && $model instanceof $auth_model) {
            return (object) [
                'id' => $model->id,
                'avatar' => (object) [
                    'chars' => $model->profile->avatarableCharacters(),
                    'color' => $model->profile->avatar->avatar_color->hex,
                    'file' => $model->profile->avatar->avatar_file,
                ],
                'name' => $model->profile->name,
            ];
        }

        return null;
    }
}
