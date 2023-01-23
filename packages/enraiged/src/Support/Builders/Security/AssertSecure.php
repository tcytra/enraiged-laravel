<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait AssertSecure
{
    /**
     *  Assert a user is authenticated.
     *
     *  @return bool
     */
    protected function assertIsAuth(): bool
    {
        return Auth::check();
    }

    /**
     *  Assert a user is not authenticated.
     *
     *  @return bool
     */
    protected function assertIsGuest(): bool
    {
        return !Auth::check();
    }

    /**
     *  Determine whether or not a provided object is secure
     *
     *  @param  array|object  $object
     *  @return bool
     */
    protected function assertSecure($object): bool
    {
        $object = (object) $object;

        if (!property_exists($object, 'secure')) {
            return true;
        }

        $security = (object) $object->secure;

        if (property_exists($security, 'method')) {
            $method = Str::camel("assert_{$security->method}");

            return method_exists($this, $method)
                ? $this->{$method}($security)
                : false;
        }

        return false;
    }
}
