<?php

namespace Enraiged\Roles\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait StrictVisibility
{
    public function scopeStrictVisibility(Builder $builder)
    {
        $builder->where('rank', '>=', Auth::user()->role->rank);
    }
}
