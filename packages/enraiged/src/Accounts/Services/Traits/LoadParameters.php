<?php

namespace Enraiged\Accounts\Services\Traits;

use Enraiged\Roles\Models\Role;

trait LoadParameters
{
    /**
     *  Load a provided set of parameters.
     *
     *  @param  array  $parameters
     *  @return self
     */
    public function load(array $parameters)
    {
        //  ensure the provided birthdate is formatted for storage
        if (key_exists('birthdate', $parameters) && $parameters['birthdate']) {
            $parameters['birthdate'] = datetime($parameters['birthdate'], 'Y-m-d');
        }

        //  split a 'name' value into first and last, if provided
        if (key_exists('name', $parameters)) {
            $names = explode(' ', $parameters['name']);

            $parameters['first_name'] = array_shift($names);
            $parameters['last_name'] = count($names)
                ? implode($names)
                : null;

            unset($parameters['name']);
        }

        //  determine the id of a role identified by its name
        if (key_exists('role', $parameters)) {
            $parameters['role_id'] = Role::where('name', $parameters['role'])
                ->first()
                ->id;

            unset($parameters['role']);
        }

        //  ensure a role is provided, if required
        if (!key_exists('role_id', $parameters) && config('auth.force_lowest_role')) {
            $parameters['role_id'] = Role::lowest()->id;
        }

        $this->parameters = $parameters;
    }
}
