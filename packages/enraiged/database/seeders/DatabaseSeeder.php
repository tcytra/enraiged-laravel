<?php

namespace Enraiged\Database\Seeders;

use App\Auth\User;
use Enraiged\Accounts\Models\Account;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $create_accounts = 123;

    /**
     *  Seed the application's database.
     *
     *  @return void
     */
    public function run()
    {
        if (app()->environment(['dev', 'development', 'local'])) {
            for ($i = 0; $i < $this->create_accounts; $i++) {
                $password = 'changeme';
                $account = $this->createFactoryAccount(['password' => $password]);
                $this->command->getOutput()->writeln("<comment>Login:</comment> <info>{$account->email}:{$password}</info>");
            }
        }
    }

    /**
     *  Create a factory account from the provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Accounts\Models\Account
     */
    protected function createFactoryAccount(array $parameters): Account
    {
        $profile = Profile::factory()->create();

        $user = User::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        $account = Account::find($user->id);
        $account->load('profile');

        return $account;
    }
}
