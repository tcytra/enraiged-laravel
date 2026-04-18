<?php

namespace App\Packages\Users\Policies;

use App\Packages\Users\Enums\Roles;
use App\Packages\Users\Models\User;

class UserPolicy
{
    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function create(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function delete(User $auth, User $user)
    {
        if ($user->isDeleted || $user->isProtected || ($user->isMyself && !$user->allowSelfDelete)) {
            return false;
        }

        return $auth->role->is(Roles::Administrator)
            || ($user->isMyself && $user->allowSelfDelete);
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function edit(User $auth, User $user)
    {
        if ($auth->role->is(Roles::Administrator) && $user->isMyself) {
            return true;
        }

        if (!is_null($user->deleted_at) || $user->isProtected) {
            return false;
        }

        return $auth->role->is(Roles::Administrator) || $user->isMyself;
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @return bool
     */
    public function export(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function impersonate(User $auth, User $user)
    {
        return $auth->role->is(Roles::Administrator)
            && !$user->isMyself
            && !$user->isDeleted
            && !$user->isProtected
            && !session()->has('impersonate');
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @return bool
     */
    public function index(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function restore(User $auth, User $user)
    {
        return $auth->role->is(Roles::Administrator) && $user->isDeleted;
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function show(User $auth, User $user)
    {
        return $auth->role->is(Roles::Administrator) || $user->isMyself;
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function store(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \App\Packages\Users\Models\User  $auth
     *  @param  \App\Packages\Users\Models\User  $user
     *  @return bool
     */
    public function update(User $auth, User $user)
    {
        if ($auth->role->is(Roles::Administrator) && $user->isMyself) {
            return true;
        }

        if (!is_null($user->deleted_at) || $user->isProtected) {
            return false;
        }

        return $auth->role->is(Roles::Administrator) || $user->isMyself;
    }
}
