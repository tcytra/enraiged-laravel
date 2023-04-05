<?php

namespace Database\Seeders;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\CreateUserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /** @var  int  Create a predetermined number of factory users to seed. */
    protected $create_users = 9;

    /** @var  string  Set this login password for the created users. */
    protected $insecure_password = 'changeme';

    /**
     *  Seed the administrator account.
     *
     *  @return void
     */
    public function run()
    {
        //  be sure to modify this config to suit the project
        $seeds = resource_path('seeds/auth/users.json');
        $users = json_decode(file_get_contents($seeds), true);

        $is_administrator = true;

        foreach ($users as $parameters) {
            if ($is_administrator) {
                $parameters['role'] = "Administrator";

                $email = key_exists('email', $parameters) ? $parameters['email'] : 'administrator@enraiged.dev';
                $parameters['email'] = env('ADMIN_EMAIL', $email);

                $password = key_exists('password', $parameters) ? $parameters['password'] : 'changeme';
                $parameters['password'] = env('ADMIN_PASSWORD', $password);

                $username = key_exists('username', $parameters) ? $parameters['username'] : 'administrator';
                $parameters['username'] = env('ADMIN_USERNAME', $username);
            }

            if (key_exists('email', $parameters) && key_exists('name', $parameters)) {
                $user = CreateUserProfile::from($parameters)->user();
                $user->profile->generateAvatar();
            }

            $is_administrator = false;
        }

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
        for ($i = 0; $i < $this->create_users; $i++) {
            $password = $this->insecure_password;
            $user = $this->createFactoryUser(['password' => $password]);

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

        $user = User::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        $user->load('profile');

        return $user;
    }
}
