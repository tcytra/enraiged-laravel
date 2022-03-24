<?php

namespace Database\Seeders;

use App\Auth\User;
use App\System\Persons\Models\Person;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::factory()->create([
            'first_name' => 'Enraiged',
            'last_name' => 'Administrator',
        ]);

        $user = User::factory()->create([
            'person_id' => $person->id,
            'email' => 'administrator@enraiged.dev',
            'password' => 'letmein!',
            'username' => 'admin@enraiged.dev',
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
