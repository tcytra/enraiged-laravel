<?php

namespace Enraiged\Users\Models\BelongsTo;

use Enraiged\Profiles\Models\Profile as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Profile
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Model::class, 'profile_id', 'id');
    }
}
