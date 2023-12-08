<?php

namespace Enraiged\Users\Traits\Assertions;

use Enraiged\Users\Models\User;

trait AssertCanBeDeleted
{
    /**
     *  Assert a user is not deleted.
     *
     *  @param  object  $secure
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    protected function assertCanBeDeleted(object $secure, User $user): bool
    {
        return is_null($user->deleted_at) && !$user->is_protected
            && ($this->request()->user()->role->is('Administrator') || $user->canBeSelfDeleted);
    }
}
