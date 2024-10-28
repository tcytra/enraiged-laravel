<?php

namespace Database\Seeders;

use Enraiged\Addresses\Models\Country;
use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\CreateUserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /** @var  int  Create a predetermined number of factory users to seed. */
    protected $create_local_users = 9;

    /** @var  string  Set this login password for the created users. */
    protected $insecure_password;

    /**
     *  Seed the administrator account.
     *
     *  @return void
     */
    public function run()
    {
        $this->insecure_password = config('enraiged.auth.insecure_password', 'changeme');

        if (app()->environment('local') && config('enraiged.auth.administrator_email')) {
            $parameters = [
                'avatar' => 'avatar-admin.jpg',
                'email' => config('enraiged.auth.administrator_email'),
                'is_hidden' => true,
                'is_protected' => true,
                'name' => config('enraiged.auth.administrator_name'),
                'password' => config('enraiged.auth.administrator_password', $this->insecure_password),
                'role' => 'Administrator',
                'timezone' => config('enraiged.app.timezone'),
                'username' => config('enraiged.auth.administrator_username'),
                'verified_at' => now(),
            ];

            $this->createUserProfile($parameters);
        }

        $this->loadJsonData(resource_path('seeds/users.json'));

        if (app()->environment('local')) {
            $this->createFactoryUsers();
        }
    }

    /**
     *  Create a predetermined number of users for testing.
     *
     *  @return self
     */
    protected function createFactoryUsers()
    {
        for ($i = 0; $i < $this->create_local_users; $i++) {
            $country = Country::where('code', config('enraiged.app.country_code'))->first();
            $password = $this->insecure_password;

            $user = $this->createFactoryUser(['password' => $password]);

            $user->profile
                ->address()
                ->create(['country_id' => $country->id]);

            if (false) {
                $this->command
                    ->getOutput()
                    ->writeln("<comment>Login:</comment> <info>{$user->email}:{$password}</info>");
            }
        }

        return $this;
    }

    /**
     *  Create a factory user from the provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Users\Models\User
     */
    protected function createFactoryUser(array $parameters): User
    {
        $profile = Profile::factory()->create();
        $profile->generateAvatar();

        $model = auth_model();

        $user = $model::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id, 'timezone' => config('enraiged.app.timezone')])
                ->toArray()
        );

        $user->load('profile');

        return $user;
    }

    /**
     *  Create a user profile from the provided parameters.
     *
     *  @param  array   $parameters
     *  @return User
     */
    protected function createUserProfile(array $parameters)
    {
        $user = CreateUserProfile::from($parameters);

        $avatar_exists = key_exists('avatar', $parameters)
            && file_exists(resource_path("seeds/avatars/{$parameters['avatar']}"));

        if ($avatar_exists) {
            $avatar_file = new File(resource_path("seeds/avatars/{$parameters['avatar']}"));
            $user->profile->avatar->seed($avatar_file);
        }

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
                $this->createUserProfile($parameters);
            }
        }
    }
}
