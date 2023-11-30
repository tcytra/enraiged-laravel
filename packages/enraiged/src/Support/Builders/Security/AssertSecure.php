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

        if (property_exists($object, 'secureAll')) {
            return $this->assertSecureAll($object, $model);
        }

        if (property_exists($object, 'secureAny')) {
            if (property_exists($object, 'secureFirst')) {
                $object->secure = $object->secureFirst; unset($object->secureFirst);
            }

            if (property_exists($object, 'secure')) {
                $first = (object) ['secure' => $object->secure];

                if (!$this->assertSecure($first, $model)) {
                    return false;
                }
            }

            $object->secure = $object->secureAny;
            unset($object->secureAny);
        }

        if (!property_exists($object, 'secure')) {
            return true;
        }

        if (is_array($object->secure)) {
            $keys = array_keys($object->secure);

            if (array_shift($keys) === 0) { // identified multiple assertions
                foreach ($object->secure as $assertion) {
                    $object = $this->securityAssertionObject($object, $assertion);

                    if ($this->assertSecure($object, $model)) {
                        return true;
                    }
                }

                return false;
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

        if (property_exists($assertion, 'env')) {
            $env = env($assertion->env);
            $value = property_exists($assertion, 'value')
                ? $assertion->value
                : true;

            return $env === $value;
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

    /**
     *  Determine whether all security assertions for the provided object are met.
     *
     *  @param  array|object  $object
     *  @param  \Illuminate\Database\Eloquent\Model  $model = null
     *  @return bool
     */
    protected function assertSecureAll($object, $model = null)
    {
        $object = (object) $object;

        $keys = array_keys($object->secureAll);

        if (array_shift($keys) !== 0) {
            return $this->assertSecure($object, $model);
        }

        foreach ($object->secureAll as $assertion) {
            $object = collect($this->securityAssertionObject($object, $assertion))
                ->except('secureAll')
                ->toArray();

            if (!$this->assertSecure($object, $model)) {
                return false;
            }
        }

        return true;
    }

    /**
     *  Provide a minimal security assertion object.
     *
     *  @param  array|object  $object
     *  @param  array|object  $assertion
     *  @return array
     */
    private function securityAssertionObject($object, $assertion)
    {
        return collect($object)
            ->except(['class', 'confirm', 'icon', 'method', 'tooltip', 'type'])
            ->merge(['secure' => $assertion])
            ->toArray();
    }
}
