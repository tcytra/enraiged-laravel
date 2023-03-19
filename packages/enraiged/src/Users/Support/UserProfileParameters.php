<?php

namespace Enraiged\Users\Support;

use Enraiged\Roles\Models\Role;

class UserProfileParameters
{
    /** @var  array  The array of provided parameters. */
    private array $parameters;

    /**
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     *  @return array
     */
    public function handle(): array
    {
        //  ensure the provided birthdate is formatted for storage
        if (key_exists('birthdate', $this->parameters) && $this->parameters['birthdate']) {
            $this->parameters['birthdate'] = datetime($this->parameters['birthdate'], 'Y-m-d');
        }

        //  split a 'name' value into first and last, if provided
        if (key_exists('name', $this->parameters)) {
            $names = explode(' ', $this->parameters['name']);

            $this->parameters['first_name'] = array_shift($names);
            $this->parameters['last_name'] = count($names)
                ? implode(' ', $names)
                : null;

            unset($this->parameters['name']);
        }

        //  determine the id of a role identified by its name
        if (key_exists('password', $this->parameters) && is_null($this->parameters['password'])) {
            unset($this->parameters['password']);
        }

        //  determine the id of a role identified by its name
        if (key_exists('role', $this->parameters)) {
            $this->parameters['role_id'] = Role::where('name', $this->parameters['role'])
                ->first()
                ->id;

            unset($this->parameters['role']);
        }

        return $this->parameters;
    }

    /**
     *  @param  array   $parameters
     *  @return array
     */
    public static function From(array $parameters): array
    {
        return (new self($parameters))->handle();
    }
}
