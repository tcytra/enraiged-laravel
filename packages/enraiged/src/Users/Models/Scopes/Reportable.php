<?php

namespace Enraiged\Users\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait Reportable
{
    /** @var  Builder  The scope query builder. */
    private $reportable;

    /**
     *  @param  \Illuminate\Database\Eloquent\Builder  $query
     *  @param  string  $columns
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReportable(Builder $query, $columns = 'users.*'): Builder
    {
        $this->reportable = $query;

        (object) $this
            ->addSelect($columns)
            ->joinProfiles()
            ->joinCountries()
            ->joinRoles()
            ->whereVisible();

        return $this->reportable;
    }

    /**
     *  @return self
     */
    private function addSelect($columns)
    {
        $columns = gettype($columns) === 'array'
            ? collect($columns)->join(',')
            : $columns;

        $this->reportable
            ->addSelect($columns);

        return $this;
    }

    /**
     *  @return self
     */
    private function joinCountries(): self
    {
        $this->reportable
            ->leftJoin('addresses', fn ($join)
                => $join
                    ->on('addresses.addressable_id', 'profiles.id')
                    ->where('addresses.addressable_type', '=', Enraiged\Profiles\Models\Profile::class))
            ->leftJoin('countries', 'countries.id', '=', 'addresses.country_id');

        return $this;
    }

    /**
     *  @return self
     */
    private function joinProfiles(): self
    {
        $this->reportable
            ->join('profiles', 'profiles.id', '=', 'users.profile_id');

        return $this;
    }

    /**
     *  @return self
     */
    private function joinRoles(): self
    {
        if (config('enraiged.auth.force_lowest_role')) {
            $this->reportable
                ->join('roles', 'roles.id', '=', 'users.role_id');
        } else {
            $this->reportable
                ->leftJoin('roles', 'roles.id', '=', 'users.role_id');
        }

        return $this;
    }

    /**
     *  @return self
     */
    private function whereVisible(): self
    {
        $this->reportable
            ->where('users.is_hidden', false);

        return $this;
    }
}
