<?php

namespace Enraiged\Roles\Policies;

use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function available(User $auth)
    {
        return $auth->exists;
    }
}
