<?php

namespace Database\Seeders;

use Enraiged\Database\Seeders\AdministratorSeeder;
use Enraiged\Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     *  Seed the application database.
     *
     *  @return void
     */
    public function run()
    {
        Artisan::call('storage:clear');

        $this->call([
            RoleSeeder::class,
            AdministratorSeeder::class,
        ]);

        $this->call([
            \Enraiged\Database\Seeders\DatabaseSeeder::class,
        ]);
    }
}
