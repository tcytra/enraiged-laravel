<?php

namespace Enraiged\Roles\Models\Relations;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyUsers
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(auth_model());
    }
}
