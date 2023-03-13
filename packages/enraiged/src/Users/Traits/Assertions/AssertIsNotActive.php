<?php

namespace Enraiged\Users\Traits\Assertions;

use Enraiged\Users\Models\User;

trait AssertIsNotActive
{
    /**
     *  Assert a user is deleted.
     *
     *  @param  object  $secure
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function assertIsNotActive(object $secure, User $user): bool
    {
        return !$user->is_active;
    }
}
