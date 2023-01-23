<?php

namespace Enraiged\Profiles\Models\HasOne;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait User
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(auth_model(), 'profile_id', 'id')
            ->withTrashed();
    }

    public static function bootUser()
    {
        static::updated(function ($profile) {
            if ($profile->user) {
                $profile->user->touch();
            }
        });
    }
}
