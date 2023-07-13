<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;

trait UserAssertions
{
    /**
     *  Assert a user id match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertUserEmail($secure): bool
    {
        $security = (object) $secure;

        if (!Auth::check()) {
            return false;
        }

        return gettype($security->email) === 'array'
            ? in_array(Auth::user()->email, $security->email)
            : Auth::user()->email === $security->email;
    }

    /**
     *  Assert a user id match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertUserId($secure): bool
    {
        $security = (object) $secure;

        if (!Auth::check()) {
            return false;
        }

        return gettype($security->id) === 'array'
            ? in_array(Auth::user()->id, $security->id)
            : Auth::user()->id === (int) $security->id;
    }
}
