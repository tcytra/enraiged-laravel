<?php

namespace Database\Seeders;

use Enraiged\Accounts\Services\CreateAccount;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('storage:clear');

        //  please be sure to set these environment variables
        $email = env('ADMIN_EMAIL', 'admin');
        $password = env('ADMIN_PASSWORD', 'changeme');

        $administrator = CreateAccount::from([
            'email' => $email,
            'is_hidden' => true,
            'is_protected' => true,
            'name' => 'Application Administrator',
            'password' => $password,
            'username' => env('ADMIN_USERNAME'),
        ]);

        $output = "<comment>Administrator Login:</comment> <info>{$administrator->email}:{$password}</info>";

        $this->command->getOutput()->writeln($output);

        $this->call([
            \Enraiged\Database\Seeders\DatabaseSeeder::class,
        ]);
    }
}
