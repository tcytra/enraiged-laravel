<?php

namespace Enraiged\Users\Policies;

use App\Enums\Roles;
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
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function avatarEdit(User $auth, User $user)
    {
        return $user->isMyself;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function loginEdit(User $auth, User $user)
    {
        return $user->isMyself;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function settingsEdit(User $auth, User $user)
    {
        return $user->isMyself;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function filesShow(User $auth, User $user)
    {
        return $user->isMyself;
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
        if (!$user->exists) {
            return $auth->canBeSelfDeleted;
        }

        if ($user->is_protected) {
            return false;
        }

        return $auth->isAdministrator || $user->canBeSelfDeleted;
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
        return $auth->isAdministrator;
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
