<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $model = config('auth.providers.users.model');

        // $model::factory(10)->create();

        $model::factory(env('SEED_USERS', 1))->create();
    }
}
