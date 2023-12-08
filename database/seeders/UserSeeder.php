<?php

namespace Database\Seeders;

use App\Enums\Roles;
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
        if ($email = env('ADMIN_EMAIL')) {
            $parameters = [
                'email' => $email,
                'is_hidden' => true,
                'is_protected' => true,
                'name' => env('ADMIN_NAME', 'Application Administrator'),
                'password' => env('ADMIN_PASSWORD', $this->insecure_password),
                'role' => 'Administrator',
                'username' => env('ADMIN_USERNAME', 'administrator'),
            ];

            $user = CreateUserProfile::from($parameters);
            $user->profile->generateAvatar();
        }

        $this->loadJsonData(resource_path('seeds/auth/users.json'));

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
     *  @return \App\GroundTruth\Users\Models\User
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
