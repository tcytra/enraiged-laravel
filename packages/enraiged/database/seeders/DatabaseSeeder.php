<?php

namespace Enraiged\Database\Seeders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /** @var  int  Create a predetermined number of factory accounts to seed. */
    protected $create_accounts = 5;

    /** @var  bool  Whether or not to output the factory account login credentials while seeding. */
    protected $output_logins = false;

    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        if (app()->environment(['dev', 'development', 'local'])) {
            for ($i = 0; $i < $this->create_accounts; $i++) {
                $password = 'changeme';
                $account = $this->createFactoryAccount(['password' => $password]);

                if ($this->output_logins) {
                    $this->command
                        ->getOutput()
                        ->writeln("<comment>Login:</comment> <info>{$account->email}:{$password}</info>");
                }
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
        $profile->generateAvatar();

        $user = Account::factory()->create(
            collect($parameters)
                ->merge(['profile_id' => $profile->id])
                ->toArray()
        );

        $account = Account::find($user->id);
        $account->load('profile');

        return $account;
    }
}
