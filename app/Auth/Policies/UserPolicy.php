<?php

namespace App\Auth\Policies;

use App\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return false;
    }

    public function delete(User $user, User $account)
    {
        return false;
    }

    public function edit(User $user, User $account)
    {
        return false;
    }

    public function export(User $user)
    {
        return false;
    }

    public function index(User $user)
    {
        return false;
    }

    public function show(User $user, User $account)
    {
        return false;
    }

    public function update(User $user, User $account)
    {
        return false;
    }
}
