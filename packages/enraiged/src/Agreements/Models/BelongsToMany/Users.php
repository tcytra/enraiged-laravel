<?php

namespace Enraiged\Agreements\Models\BelongsToMany;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Users
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(auth_model(), 'agreement_user', 'id', 'agreement_by');
    }
}
