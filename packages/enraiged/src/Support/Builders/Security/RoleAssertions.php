<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;

trait RoleAssertions
{
    /**
     *  Assert a minimum role match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleAtLeast($secure): bool
    {
        $security = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->atLeast($security->role)
            : false;
    }

    /**
     *  Assert a role match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleIs($secure): bool
    {
        $security = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->is($security->role)
            : false;
    }

    /**
     *  Assert a role does not match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleIsNot($secure): bool
    {
        $security = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->isNot($security->role)
            : false;
    }
}
