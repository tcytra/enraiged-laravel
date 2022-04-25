<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Support\Str;

trait SecurityAssertions
{
    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = false;

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

    /**
     *  Assert a minimum role match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleAtLeast($secure): bool
    {
        $security = (object) $secure;

        return $this->request()->user()->role->atLeast($security->role);
    }

    /**
     *  Assert a role match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleIs($secure): bool
    {
        $security = (object) $secure;

        return $this->request()->user()->role->is($security->role);
    }

    /**
     *  Assert a role does not match.
     *
     *  @param  object  $secure
     *  @return bool
     */
    protected function assertRoleIsNot($secure): bool
    {
        $security = (object) $secure;

        return $this->request()->user()->role->isNot($security->role);
    }
}
