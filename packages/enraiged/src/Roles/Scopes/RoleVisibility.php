<?php

namespace Enraiged\Roles\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class RoleVisibility implements Scope
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        //dd(Auth::user());
        //$builder->where('rank', '>=', Auth::user()->role->rank);
    }
}
