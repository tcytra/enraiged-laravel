<?php

namespace Enraiged\Accounts\Policies;

use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Enraiged\Roles\Enums\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     *  @param  \App\Auth\User  $user
     *  @return bool|void
     */
    public function before(User $user)
    {
        if ($user->role->is(Roles::Administrator)) {
            return true;
        }
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @return bool
     */
    public function create(User $user)
    {
        return $user->role->atLeast(Roles::Administrator);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return bool
     */
    public function delete(User $user, Account $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            && !$account->is_protected;
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return bool
     */
    public function edit(User $user, Account $account)
    {
        return $this->update($user, $account);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @return bool
     */
    public function export(User $user)
    {
        return $this->index($user);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return bool
     */
    public function impersonate(User $user, Account $account)
    {
        return $user->canImpersonate($account->user);
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @return bool
     */
    public function index(User $user)
    {
        return $user->exists;
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return bool
     */
    public function show(User $user, Account $account)
    {
        return $user->exists && $account->exists;
    }

    /**
     *  @param  \App\Auth\User  $user
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return bool
     */
    public function update(User $user, Account $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            || $user->id === $account->id;
    }
}
