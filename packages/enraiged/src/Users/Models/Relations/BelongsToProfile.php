<?php

namespace Enraiged\Users\Models\Relations;

use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProfile
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
