<?php

namespace Enraiged\Support\Builders\Security;

use Enraiged\Enums\Roles;
use Illuminate\Support\Facades\Auth;

trait RoleAssertions
{
    /**
     *  Assert a user is authenticated.
     *
     *  @return bool
     */
    protected function assertIsAdministrator(): bool
    {
        return Auth::check() && Auth::user()->role->is(Roles::Administrator);
    }

    /**
     *  Assert a minimum role match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleAtLeast($secure): bool
    {
        $secure = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->atLeast($secure->role)
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
        $secure = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->is($secure->role)
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
        $secure = (object) $secure;

        return Auth::check() && Auth::user()->hasRole()
            ? Auth::user()->role->isNot($secure->role)
            : false;
    }
}
