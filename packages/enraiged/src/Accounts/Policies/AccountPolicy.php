<?php

namespace Enraiged\Accounts\Policies;

use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Enraiged\Roles\Enums\Roles;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role->atLeast(Roles::Administrator);
    }

    public function delete(User $user, Account $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            && !$account->is_protected;
    }

    public function edit(User $user, Account $account)
    {
        return $this->update($user, $account);
    }

    public function export(User $user)
    {
        return $this->index($user);
    }

    public function index(User $user)
    {
        return $user->exists;
    }

    public function show(User $user, Account $account)
    {
        return $user->exists && $account->exists;
    }

    public function update(User $user, Account $account)
    {
        return $user->role->atLeast(Roles::Administrator)
            || $user->id === $account->id;
    }
}
