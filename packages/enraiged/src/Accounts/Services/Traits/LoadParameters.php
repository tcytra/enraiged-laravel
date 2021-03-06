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
        $called_class = get_called_class();
        $creating = preg_match('/CreateAccount$/', $called_class);
        $updating = preg_match('/UpdateAccount$/', $called_class);

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
        if (key_exists('password', $parameters) && is_null($parameters['password'])) {
            unset($parameters['password']);
        }

        //  determine the id of a role identified by its name
        if (key_exists('role', $parameters)) {
            $parameters['role_id'] = Role::where('name', $parameters['role'])
                ->first()
                ->id;

            unset($parameters['role']);
        }

        //  ensure a role is provided, if required
        if ($creating && !key_exists('role_id', $parameters) && config('enraiged.auth.force_lowest_role')) {
            $parameters['role_id'] = Role::lowest()->id;
        }

        //  ensure a role is not self-elevating
        if ($updating && key_exists('role_id', $parameters) && $this->account->is_myself) {
            //  todo?
        }

        $this->parameters = $parameters;
    }
}
