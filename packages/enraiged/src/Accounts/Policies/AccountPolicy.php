<?php

namespace Enraiged\Accounts\Policies;

use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->id === 1;
    }

    public function delete(User $user, Account $account)
    {
        return $user->exists && $account->exists && !$account->is_protected;
    }

    public function edit(User $user, Account $account)
    {
        return $user->exists && $account->exists;
    }

    public function export(User $user)
    {
        return $user->exists;
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
        return $user->id === 1
            || $user->id === $account->id;
    }
}
