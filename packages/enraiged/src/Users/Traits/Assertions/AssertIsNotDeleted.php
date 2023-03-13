<?php

namespace Enraiged\Users\Traits\Assertions;

use Enraiged\Users\Models\User;

trait AssertIsNotDeleted
{
    /**
     *  Assert a user is not deleted.
     *
     *  @param  object  $secure
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function assertIsNotDeleted(object $secure, User $user): bool
    {
        return is_null($user->deleted_at);
    }
}
