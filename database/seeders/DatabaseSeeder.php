<?php

namespace Database\Seeders;

use App\Auth\User;
use App\Account\Models\Profile;
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
        $profile = Profile::factory()->create([
            'first_name' => 'Enraiged',
            'last_name' => 'Administrator',
            'salut' => null,
        ]);

        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'email' => 'administrator@demo.dev',
            'password' => 'letmein!',
            'username' => 'administrator',
        ]);

        //\App\Models\User::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
            $password = 'changeme';
            $user = $this->createRandomAccount(['password' => $password]);
            $this->command->getOutput()->writeln("<comment>Login:</comment> <info>{$user->email}:{$password}</info>");
        }
    }

    protected function createRandomAccount($parameters)
    {
        $profile = Profile::factory()->create();

        $user = User::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        return $user->load('profile');
    }
}
