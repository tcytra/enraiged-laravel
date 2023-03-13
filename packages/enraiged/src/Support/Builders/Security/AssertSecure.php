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
     *  Determine whether or not a provided object is secure.
     *
     *  @param  array|object  $object
     *  @param  \Illuminate\Database\Eloquent\Model  $model = null
     *  @return bool
     */
    protected function assertSecure($object, $model = null): bool
    {
        $object = (object) $object;

        if (!property_exists($object, 'secure')) {
            return true;
        }

        if (is_array($object->secure)) {
            $keys = array_keys($object->secure);

            if (array_shift($keys) === 0) { // identified multiple assertions
                foreach ($object->secure as $assertion) {
                    $object = collect($object)
                        ->except(['class', 'confirm', 'icon', 'method', 'tooltip', 'type'])
                        ->merge(['secure' => $assertion])
                        ->toArray();

                    if (!$this->assertSecure($object, $model)) {
                        return false;
                    }
                }

                return true;
            }
        }

        if (gettype($object->secure) === 'string' && preg_match('/^[a-z][a-z-_]+$/', $object->secure)) {
            return !property_exists($object, $object->secure)|| $object->{$object->secure} === true;
        }

        $assertion = (object) $object->secure;

        if (property_exists($assertion, 'config')) {
            $config = config($assertion->config);
            $value = property_exists($assertion, 'value')
                ? $assertion->value
                : true;

            return $config === $value;
        }

        if (property_exists($assertion, 'method')) {
            $method = preg_match('/^assert/', $assertion->method)
                ? $assertion->method
                : Str::camel("assert_{$assertion->method}");

            return method_exists($this, $method)
                ? $this->{$method}($assertion, $model)
                : false;
        }

        return false;
    }
}
