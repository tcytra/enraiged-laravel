<?php

namespace Enraiged\Users\Models\BelongsTo;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait User
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(auth_model(), 'user_id', 'id');
    }
}
