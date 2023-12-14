<?php

namespace Enraiged\Profiles\Models\Relations;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasOneUser
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(auth_model(), 'profile_id', 'id')
            ->withTrashed();
    }

    /**
     *  @return void
     */
    public static function bootUser()
    {
        static::updated(function ($profile) {
            if ($profile->user) {
                $profile->user->touch();
            }
        });
    }
}
