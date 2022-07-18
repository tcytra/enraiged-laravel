<?php

namespace Enraiged\Roles\Models\HasMany;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait Users
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(auth_model());
    }
}
