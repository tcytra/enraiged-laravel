<?php

namespace Enraiged\Agreements\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyUsers
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(auth_model(), 'agreement_user', 'id', 'agreement_by');
    }
}
