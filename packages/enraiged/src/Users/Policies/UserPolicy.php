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
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function _read(User $auth, User $user = null)
    {
        return $auth->exists && $user->exists;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function _write(User $auth, User $user = null)
    {
        return $auth->role->is(Roles::Administrator)
            || $auth->id === $user->id;
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function available(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function avatarEdit(User $auth, User $user)
    {
        return $this->_write($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function loginEdit(User $auth, User $user)
    {
        return $this->_write($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function settingsEdit(User $auth, User $user)
    {
        return $this->_write($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function create(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function delete(User $auth, User $user)
    {
        return $this->_write($auth, $user)
            && is_null($user->deleted_at);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function edit(User $auth, User $user)
    {
        return $this->_write($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @return bool
     */
    public function export(User $auth)
    {
        return $auth->role->is(Roles::Administrator);
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
        return $auth->role->is(Roles::Administrator);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function restore(User $auth, User $user)
    {
        return $this->_write($auth, $user)
            && !is_null($user->deleted_at);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function show(User $auth, User $user)
    {
        return $this->_read($auth, $user);
    }

    /**
     *  @param  \Enraiged\Users\Models\User  $auth
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return bool
     */
    public function update(User $auth, User $user)
    {
        return $this->_write($auth, $user);
    }
}
