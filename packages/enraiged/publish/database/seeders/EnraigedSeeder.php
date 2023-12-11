<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class EnraigedSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('storage:clear');

        $this->call([
            AgreementSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
