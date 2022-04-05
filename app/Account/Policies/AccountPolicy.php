<?php

namespace App\Account\Policies;

use App\Account\Models\Account;
use App\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Account $account)
    {
        return $user->id === $account->id;
    }

    public function update(User $user, Account $account)
    {
        return $user->id === $account->id;
    }
}
