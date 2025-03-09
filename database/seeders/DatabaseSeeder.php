<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $model = config('auth.providers.users.model');

        // $model::factory(10)->create();

        $model::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
