<?php

namespace Database\Seeders;

use Enraiged\Profiles\Models\Profile;
use Enraiged\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /** @var  int  Create a predetermined number of factory users to seed. */
    protected $create_users = 9;

    /** @var  string  Set this login password for the created users. */
    protected $insecure_password = 'changeme';

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

        if (app()->environment(['dev', 'development', 'local'])) {
            $this->createUsers();
        }
    }

    /**
     *  Create a predetermined number of users for testing.
     *
     *  @return self
     */
    protected function createUsers()
    {
        for ($i = 0; $i < $this->create_users; $i++) {
            $password = $this->insecure_password;
            $user = $this->createFactoryUser(['password' => $password]);

            if (false) {
                $this->command
                    ->getOutput()
                    ->writeln("<comment>Login:</comment> <info>{$user->email}:{$password}</info>");
            }
        }

        return $this;
    }

    /**
     *  Create a factory user from the provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Users\Models\User
     */
    protected function createFactoryUser(array $parameters): User
    {
        $profile = Profile::factory()->create();
        $profile->generateAvatar();

        $user = User::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        $user->load('profile');

        return $user;
    }
}
