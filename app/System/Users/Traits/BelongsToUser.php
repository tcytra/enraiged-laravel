<?php

namespace App\System\Users\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        $model = config('auth.providers.users.model');

        return $this->belongsTo($model, 'user_id', 'id');
    }
}
