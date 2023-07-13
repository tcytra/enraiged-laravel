<?php

namespace Enraiged\Users\Policies;

use App\Auth\Enums\Roles;
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
        return $auth->role->atLeast(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function create(User $auth)
    {
        return $auth->role->atLeast(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function delete(User $auth, User $user)
    {
        return $auth->role->atLeast(Roles::Administrator)
            && !$user->is_protected
            && is_null($user->deleted_at);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function edit(User $auth, User $user)
    {
        return $this->update($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function export(User $auth)
    {
        return $this->index($auth);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function impersonate(User $auth, User $user)
    {
        return is_null($user->deleted_at)
            && $auth->canImpersonate($user)
            && $auth->id !== $user->id;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function index(User $auth)
    {
        return $auth->exists;
    }

    /**
     *  @param  \App\Auth\User  $auth
     *  @param  \App\GroundTruth\Users\Models\User  $user
     *  @return bool
     */
    public function restore(User $auth, User $user)
    {
        return $auth->role->atLeast(Roles::Administrator)
            && !is_null($user->deleted_at);
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
        if ($user->deleted_at) {
            return false;
        }

        return $auth->role->is(Roles::Administrator)
            || $auth->id === $user->id;
    }
}
