<?php

namespace Enraiged\Accounts\Policies;

use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Account $account)
    {
        return $user->id === $account->id;
    }

    public function index(User $user)
    {
        return $user->exists;
    }

    public function update(User $user, Account $account)
    {
        return $user->id === $account->id;
    }
}
