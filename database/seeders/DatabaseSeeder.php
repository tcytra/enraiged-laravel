<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     *  Seed the application's database.
     *
     *  @return void
     */
    public function run(): void
    {
        if (!app()->environment('production')) {
            // Artisan::call('storage:clear');

            $this->call([
                UserSeeder::class,
            ]);
        }
    }
}
