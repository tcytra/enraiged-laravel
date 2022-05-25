<?php

namespace App\Auth\Traits\BelongsTo;

use App\Auth\User as UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait User
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}
