<?php

namespace Enraiged\Users\Policies;

use Enraiged\Enums\Roles;
use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function available(User $auth)
    {
        return $auth->isAdministrator;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function create(User $auth)
    {
        return $auth->isAdministrator;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function delete(User $auth, User $user)
    {
        if (!is_null($user->deleted_at) || $user->isProtected || ($user->isMyself && !$user->canBeSelfDeleted)) {
            return false;
        }

        return $auth->isAdministrator || ($user->isMyself && $user->canBeSelfDeleted);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function edit(User $auth, User $user)
    {
        return $auth->isAdministrator || $user->isMyself;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function export(User $auth)
    {
        return $auth->isAdministrator;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function impersonate(User $auth, User $user)
    {
        return $auth->canImpersonate($user) && !$user->isMyself;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function index(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function restore(User $auth, User $user)
    {
        return !is_null($user->deleted_at) && $auth->isAdministrator;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function show(User $auth, User $user)
    {
        return $auth->exists && $user->exists;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function update(User $auth, User $user)
    {
        return $auth->isAdministrator || $user->isMyself;
    }
}
