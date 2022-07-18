<?php

namespace Enraiged\Database\Seeders;

use Enraiged\Accounts\Models\Account;
use Enraiged\Agreements\Models\Agreement;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /** @var  int  Create a predetermined number of factory accounts to seed. */
    protected $create_accounts = 5;

    /** @var  string  Set this login password for the created accounts. */
    protected $insecure_password = 'changeme';

    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        $this->createAgreements();

        if (app()->environment(['dev', 'development', 'local'])) {
            $this->createAccounts();
        }
    }

    /**
     *  Create a predetermined number of accounts for testing.
     *
     *  @return self
     */
    protected function createAccounts()
    {
        for ($i = 0; $i < $this->create_accounts; $i++) {
            $password = $this->insecure_password;
            $account = $this->createFactoryAccount(['password' => $password]);

            if (false) {
                $this->command
                    ->getOutput()
                    ->writeln("<comment>Login:</comment> <info>{$account->email}:{$password}</info>");
            }
        }

        return $this;
    }

    /**
     *  Create the placeholder agreements for testing.
     *
     *  @return self
     */
    protected function createAgreements()
    {
        $config = config('enraiged.auth.must_agree_to_terms');

        if ($config && $config !== false) {
            foreach (['EULA', 'TOS'] as $type) {
                $resource = resource_path("seeds/agreements/{$type}.md");
                $content = file_exists($resource)
                    ? file_get_contents($resource)
                    : 'No content';

                $parameters = [
                    'content' => $content,
                    'type' => $type,
                    'version' => '1.0.0',
                ];

                Agreement::create($parameters)->publish();
            }
        }

        return $this;
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
