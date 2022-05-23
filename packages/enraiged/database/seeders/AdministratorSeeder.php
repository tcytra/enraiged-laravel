<?php

namespace Enraiged\Database\Seeders;

use Enraiged\Accounts\Services\CreateAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     *  Seed the administrator account.
     *
     *  @return void
     */
    public function run()
    {
        //  please be sure to set these environment variables
        $email = env('ADMIN_EMAIL', 'admin@nowhere.local');
        $password = env('ADMIN_PASSWORD', 'changeme');

        $administrator = CreateAccount::from([
            'email' => $email,
            'is_hidden' => true,
            'is_protected' => true,
            'name' => 'Application Administrator',
            'password' => $password,
            'role' => 'Administrator',
            'username' => env('ADMIN_USERNAME'),
        ]);

        $administrator->profile->generateAvatar();

        $output = "<comment>Administrator Login:</comment> <info>{$administrator->email}:{$password}</info>";

        $this->command->getOutput()->writeln($output);
    }
}
