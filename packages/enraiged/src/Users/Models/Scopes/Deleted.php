<?php

namespace Enraiged\Users\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait Deleted
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereDeleted(Builder $builder): Builder
    {
        return $builder->withTrashed()
            ->whereNotNull('users.deleted_at');
    }
}
