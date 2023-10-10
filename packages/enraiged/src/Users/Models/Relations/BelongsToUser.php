<?php

namespace Enraiged\Users\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(auth_model(), 'user_id', 'id');
    }
}
