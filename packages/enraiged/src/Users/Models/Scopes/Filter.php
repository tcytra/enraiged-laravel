<?php

namespace Enraiged\Users\Models\Scopes;

trait Filter
{
    /**
     *  Apply filters to the User model.
     *
     *  @param  object  $query
     *  @param  array   $filters
     */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });

        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereRole($role);

        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }
}
