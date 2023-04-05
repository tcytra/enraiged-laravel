<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        Artisan::call('storage:clear');

        $this->call([
            AgreementSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
