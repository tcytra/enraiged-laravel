<?php

namespace Database\Seeders;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Enums\Roles;
use Enraiged\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     *  Seed the users.
     *
     *  @return void
     */
    public function run()
    {
        $this->loadJsonData(resource_path('seeds/users.json'));

        $model = config('auth.providers.users.model');

        $model::factory(env('SEED_USERS'))->create();
    }

    /**
     *  Create a user profile from the provided parameters.
     *
     *  @return \Enraiged\Users\Models\User
     */
    protected function createUserProfile($parameters): User
    {
        if (key_exists('name', $parameters)) {
            $names = explode(' ', $parameters['name']);
            $parameters['first_name'] = count($names) ? array_shift($names) : null;
            $parameters['last_name'] = count($names) ? implode(' ', $names) : null;
        }

        if (key_exists('role', $parameters)) {
            $roles = config('auth.providers.roles.enum', Roles::class);
            $role = $roles::{$parameters['role']};

            $parameters['role_id'] = $role->role()->id;

            unset($parameters['role']);
        }

        $attributes = collect($parameters);

        $model = config('auth.providers.users.model');

        $user = (new $model);

        $profile = Profile::create(
            $attributes
                ->only((new Profile)->getFillable())
                ->toArray()
        );

        $user
            ->fill($attributes
                ->only($user->getFillable())
                ->merge(['profile_id' => $profile->id])
                ->toArray())
            ->save();

        return $user;
    }

    /**
     *  Create user accounts from a provided json file.
     *
     *  @param  string  $seeds
     *  @return void
     */
    protected function loadJsonData($seeds)
    {
        $users = json_decode(file_get_contents($seeds), true);

        foreach ($users as $parameters) {
            $email_exists = key_exists('email', $parameters);
            $name_exists = key_exists('name', $parameters);

            if ($email_exists && $name_exists && !User::where('email', $parameters['email'])->exists()) {
                DB::transaction(fn ()
                    => $this->createUserProfile($parameters));
            }
        }
    }
}
