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
                'email' => config('enraiged.auth.administrator_email'),
                'is_hidden' => true,
                'is_protected' => true,
                'name' => config('enraiged.auth.administrator_name'),
                'password' => config('enraiged.auth.administrator_password', $this->insecure_password),
                'role' => 'Administrator',
                'timezone' => config('enraiged.app.timezone'),
                'username' => config('enraiged.auth.administrator_username'),
            ];

            $user = CreateUserProfile::from($parameters);
            $user->profile->generateAvatar();
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
                ->merge(['profile_id' => $profile->id, 'timezone' => config('enraiged.app.timezone')])
                ->toArray()
        );

        $user->load('profile');

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
            if (key_exists('email', $parameters) && key_exists('name', $parameters)) {
                if (!User::where('email', $parameters['email'])->exists()) {
                    $user = CreateUserProfile::from($parameters);
                    $user->profile->generateAvatar();
                }
            }
        }
    }
}
