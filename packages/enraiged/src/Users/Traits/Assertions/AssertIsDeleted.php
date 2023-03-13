<?php

namespace Enraiged\Users\Traits\Assertions;

use Enraiged\Users\Models\User;

trait AssertIsDeleted
{
    /**
     *  Assert a user is deleted.
     *
     *  @param  object  $secure
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function assertIsDeleted(object $secure, User $user): bool
    {
        return !is_null($user->deleted_at);
    }
}
