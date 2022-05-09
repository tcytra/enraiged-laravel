<?php

namespace Enraiged\Profiles\Models\HasOne;

use Enraiged\Accounts\Models\Account as AccountModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Account
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(AccountModel::class, 'profile_id', 'id')
            ->withTrashed();
    }

    public static function bootAccount()
    {
        static::updated(function ($profile) {
            if ($profile->account) {
                $profile->account->touch();
            }
        });
    }
}
