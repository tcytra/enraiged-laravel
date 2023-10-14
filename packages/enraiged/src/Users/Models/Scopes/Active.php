<?php

namespace Enraiged\Users\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait Active
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereActive(Builder $builder): Builder
    {
        return $builder
            ->where('users.is_active', true);
    }

    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereInactive(Builder $builder): Builder
    {
        return $builder
            ->where('users.is_active', false);
    }
}
