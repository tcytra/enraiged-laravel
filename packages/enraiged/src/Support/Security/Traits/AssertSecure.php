<?php

namespace Enraiged\Support\Security\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait AssertSecure
{
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

        if (!Auth::check()) {
            return false;
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
