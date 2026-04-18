<?php

namespace App\Packages\Users\Models\Relations;

use App\Packages\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToProfile
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    #[\Override]
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
