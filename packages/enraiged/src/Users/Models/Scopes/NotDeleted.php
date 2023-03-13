<?php

namespace Enraiged\Users\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait NotDeleted
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereNotDeleted(Builder $builder): Builder
    {
        return $builder->whereNull('users.deleted_at');
    }
}
