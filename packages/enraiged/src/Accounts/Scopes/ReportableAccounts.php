<?php

namespace Enraiged\Accounts\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ReportableAccounts implements Scope
{
    /** @var  object  The eloquent query builder. */
    protected $builder;

    /** @var  object  The eloquent data model. */
    protected $model;

    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $this->builder = $builder->select('users.*');
        $this->model = $model;

        (object) $this
            ->joinProfiles()
            ->joinRoles()
            ->whereVisible();
    }

    /**
     *  @return self
     */
    private function joinProfiles(): self
    {
        $this->builder->join('profiles', 'profiles.id', '=', 'users.profile_id');

        return $this;
    }

    /**
     *  @return self
     */
    private function joinRoles(): self
    {
        if (config('auth.force_lowest_role')) {
            $this->builder->join('roles', 'roles.id', '=', 'users.role_id');
        } else {
            $this->builder->leftJoin('roles', 'roles.id', '=', 'users.role_id');
        }

        return $this;
    }

    /**
     *  @return self
     */
    private function whereVisible(): self
    {
        $this->builder->where('is_hidden', false);

        return $this;
    }
}
