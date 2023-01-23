<?php

namespace Database\Seeders;

use Enraiged\Users\Services\CreateUserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

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
                $user = CreateUserProfile::from($parameters);
                $user->profile->generateAvatar();

                $this->command
                    ->getOutput()
                    ->writeln("<comment>Administrator Login:</comment> <info>{$user->email}:{$parameters['password']}</info>");
            }

            $is_administrator = false;
        }
    }
}
