<?php

namespace Database\Seeders;

use Enraiged\Database\Seeders\RoleSeeder;
use Enraiged\Database\Seeders\UserSeeder;
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
            UserSeeder::class,
        ]);

        $this->call([
            \Enraiged\Database\Seeders\DatabaseSeeder::class,
        ]);
    }
}
