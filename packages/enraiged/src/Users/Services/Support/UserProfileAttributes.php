<?php

namespace Enraiged\Users\Services\Support;

use Enraiged\Addresses\Models\Country;
use Enraiged\Roles\Models\Role;
use Enraiged\Support\Services\AttributeHandler;
use Illuminate\Support\Str;

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

        //  remove the password attribute if the value is null
        if (key_exists('password', $this->attributes) && is_null($this->attributes['password'])) {
            unset($this->attributes['password']);
        }

        if ($this->creating) {
            //  ensure a default password is provided, if none exists
            if (!key_exists('password', $this->attributes)) {
                $this->attributes['password'] = config('enraiged.auth.insecure_password') === 'random'
                    ? Str::random(8)
                    : config('enraiged.auth.insecure_password');
            }

            //  attempt to set a role name, if none exists
            if (!is_null(config('enraiged.auth.force_default_role'))
                && !key_exists('role_id', $this->attributes)
                && !key_exists('role', $this->attributes)) {
                $this->attributes['role'] = config('enraiged.auth.force_default_role');
            }

            //  ensure a country id is provided, if none exists
            if (!key_exists('country_id', $this->attributes)) {
                $country = Country::where('code', config('enraiged.app.country_code'))->first();

                $this->attributes['country_id'] = $country->id;
            }
        }

        //  determine the id of a role identified by its name
        if (key_exists('role', $this->attributes) && !is_null($this->attributes['role'])) {
            $this->attributes['role_id'] = Role::where('name', $this->attributes['role'])
                ->first()
                ->id;

            unset($this->attributes['role']);
        }

        return $this;
    }
}
