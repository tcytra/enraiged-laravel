<?php

namespace Enraiged\Accounts\Models\HasOne;

// use App\Auth\User as UserModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait User
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(auth_model(), 'id', 'id')->withTrashed();
    }
}
