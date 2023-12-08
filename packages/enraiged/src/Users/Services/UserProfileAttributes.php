<?php

namespace Enraiged\Users\Services;

use Enraiged\Roles\Models\Role;
use Enraiged\Support\Services\AttributeHandler;

class UserProfileAttributes extends AttributeHandler
{
    /**
     *  @return self
     */
    public function handle(): self
    {
        //  ensure the provided birthdate is formatted for storage
        if (key_exists('birthdate', $this->attributes) && $this->attributes['birthdate']) {
            $this->attributes['birthdate'] = datetime($this->attributes['birthdate'], 'Y-m-d');
        }

        //  split a 'name' value into first and last, if provided
        if (key_exists('name', $this->attributes)) {
            $names = explode(' ', $this->attributes['name']);

            $this->attributes['first_name'] = array_shift($names);
            $this->attributes['last_name'] = count($names)
                ? implode(' ', $names)
                : null;

            unset($this->attributes['name']);
        }

        //  remove the password attribute if not in the provided collection
        if (key_exists('password', $this->attributes) && is_null($this->attributes['password'])) {
            unset($this->attributes['password']);
        }

        //  determine the id of a role identified by its name
        if (key_exists('role', $this->attributes)) {
            /*
            $role = preg_match('/\d+/', $this->attributes['role'])
                ? Role::find($this->attributes['role'])
                : Role::where('name', $this->attributes['role'])->first();

            if ($role->exists) {
                $this->attributes['role_id'] = $role->id;
            }
            */

            $this->attributes['role_id'] = Role::where('name', $this->attributes['role'])
                ->first()
                ->id;

            unset($this->attributes['role']);
        }

        return $this;
    }
}
