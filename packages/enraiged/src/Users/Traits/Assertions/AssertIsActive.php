<?php

namespace Enraiged\Users\Traits\Assertions;

use Enraiged\Users\Models\User;

trait AssertIsActive
{
    /**
     *  Assert a user is active.
     *
     *  @param  object  $secure
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function assertIsActive(object $secure, User $user): bool
    {
        return $user->is_active;
    }
}
