<?php

namespace Enraiged\Accounts\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ReportableAccounts implements Scope
{
    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder
            ->join('profiles', 'profiles.id', '=', 'users.profile_id')
            ->where('is_hidden', false);
    }
}
