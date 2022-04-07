<?php

namespace App\Auth\Traits\BelongsTo;

use Enraiged\Accounts\Models\Account as AccountModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait Account
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(AccountModel::class, 'id', 'id')->withTrashed();
    }
}
