<?php

namespace Enraiged\Users\Policies;

use App\Auth\Enums\Roles;
use Enraiged\Users\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function available(User $user)
    {
        return $user->role->atLeast(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function create(User $user)
    {
        return $user->role->atLeast(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Users\Models\User  $account
     *  @return bool
     */
    public function delete(User $user, User $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            && !$account->is_protected
            && is_null($account->deleted_at);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Users\Models\User  $account
     *  @return bool
     */
    public function edit(User $user, User $account)
    {
        return $this->update($user, $account);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function export(User $user)
    {
        return $this->index($user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Users\Models\User  $account
     *  @return bool
     */
    public function impersonate(User $user, User $account)
    {
        return is_null($account->deleted_at)
            && $user->canImpersonate($account);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function index(User $user)
    {
        return $user->exists;
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \App\GroundTruth\Users\Models\User  $account
     *  @return bool
     */
    public function restore(User $user, User $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            && !is_null($account->deleted_at);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Users\Models\User  $account
     *  @return bool
     */
    public function show(User $user, User $account)
    {
        return $user->exists && $account->exists;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $user
     *  @param  \Enraiged\Users\Models\User  $account
     *  @return bool
     */
    public function update(User $user, User $account)
    {
        if ($account->deleted_at) {
            return false;
        }

        return $user->role->is(Roles::Administrator)
            || $user->id === $account->id;
    }
}
