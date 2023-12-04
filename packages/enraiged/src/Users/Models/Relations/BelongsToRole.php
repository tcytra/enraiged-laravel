<?php

namespace Enraiged\Users\Models\Relations;

use Enraiged\Roles\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRole
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     *  Determine whether this user belongs to a role.
     *
     *  @return bool
     */
    public function hasRole(): bool
    {
        return !is_null($this->role_id);
    }

    /**
     *  Determine whether this user outranks another user in role.
     *
     *  @param  \Illuminate\Foundation\Auth\User  $user
     *  @return bool
     */
    public function outranks($user)
    {
        authenticable_check($user);

        return $this->role->rank < $user->role->rank;
    }
}
