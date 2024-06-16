<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;

trait UserAssertions
{
    /**
     *  Assert a user email match.
     *
     *  @param  array|object  $secure
     *  @return bool
     */
    protected function assertUserHasPermission($secure, $model): bool
    {
        $secure = (object) $secure;

        if (!Auth::check() || !property_exists($secure, 'permission') || is_null($model)) {
            return false;
        }

        return Auth::user()->can($secure->permission, $model);
    }

    /**
     *  Assert a user email match.
     *
     *  @param  array|object  $secure
     *  @return bool
     */
    protected function assertUserEmail($secure): bool
    {
        $secure = (object) $secure;

        if (!Auth::check() || !property_exists($secure, 'email')) {
            return false;
        }

        return gettype($secure->email) === 'array'
            ? in_array(Auth::user()->email, $secure->email)
            : Auth::user()->email === (int) $secure->email;
    }

    /**
     *  Assert a user id match.
     *
     *  @param  array|object  $secure
     *  @return bool
     */
    protected function assertUserId($secure): bool
    {
        $secure = (object) $secure;

        if (!Auth::check() || !property_exists($secure, 'id')) {
            return false;
        }

        return gettype($secure->id) === 'array'
            ? in_array(Auth::user()->id, $secure->id)
            : Auth::user()->id === (int) $secure->id;
    }
}
