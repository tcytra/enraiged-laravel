<?php

namespace Enraiged\Accounts\Models\HasOne;

use Enraiged\Profiles\Models\Profile as ProfileModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Profile
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(ProfileModel::class, 'profile_id', 'id');
    }
}
