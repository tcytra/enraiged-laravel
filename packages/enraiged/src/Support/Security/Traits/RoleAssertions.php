<?php

namespace Enraiged\Support\Security\Traits;

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

        return $this->request()->user()->role->atLeast($security->role);
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

        return $this->request()->user()->role->is($security->role);
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

        return $this->request()->user()->role->isNot($security->role);
    }
}
