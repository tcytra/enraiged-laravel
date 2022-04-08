<?php

namespace Enraiged\Accounts\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AccountVisibility implements Scope
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_hidden', false);
    }
}
