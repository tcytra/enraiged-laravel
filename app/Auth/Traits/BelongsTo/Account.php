<?php

namespace App\Auth\Traits\BelongsTo;

use Enraiged\Accounts\Models\Account as AccountModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Account
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccountModel::class, 'id', 'id')->withTrashed();
    }
}
