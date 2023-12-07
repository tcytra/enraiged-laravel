<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;

trait UserAssertions
{
    /**
     *  Assert a user id match.
     *
     *  @param  array|object  $user
     *  @return bool
     */
    protected function assertUserEmail($user): bool
    {
        $user = (object) $user;

        if (!Auth::check()) {
            return false;
        }

        return gettype($user->email) === 'array'
            ? in_array(Auth::user()->email, $user->email)
            : Auth::user()->email === $user->email;
    }

    /**
     *  Assert a user model is myself.
     *
     *  @param  User  $user
     *  @return bool
     */
    protected function assertUserIsMyself($user): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return Auth::user()->id === (int) $user->id;
    }

    /**
     *  Assert a user id match.
     *
     *  @param  array|User  $user
     *  @return bool
     */
    protected function assertUserId($user): bool
    {
        $user = (object) $user;

        if (!Auth::check()) {
            return false;
        }

        return gettype($user->id) === 'array'
            ? in_array(Auth::user()->id, $user->id)
            : Auth::user()->id === (int) $user->id;
    }
}
