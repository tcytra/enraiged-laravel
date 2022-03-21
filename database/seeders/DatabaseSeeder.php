<?php

namespace Database\Seeders;

use App\Auth\User;
use App\System\Persons\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $person = Person::factory()->create([
            'first_name' => 'Tyler',
            'last_name' => 'Wood',
        ]);

        $user = User::factory()->create([
            'person_id' => $person->id,
            'email' => 'tyler.wood@enraiged.dev',
            'password' => 'letmein!',
        ]);
    }
}
