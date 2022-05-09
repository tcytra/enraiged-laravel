<?php

namespace Enraiged\Accounts\Services;

use Enraiged\Accounts\Events\AccountCreated;
use Enraiged\Accounts\Models\Account;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Support\Facades\DB;

class CreateAccount
{
    use Traits\LoadParameters;

    /** @var  object  The Account model. */
    protected $account;

    /** @var  array  The provided parameters. */
    protected $parameters;

    /**
     *  Create an instance of the CreateAccount service.
     *
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(array $parameters)
    {
        $this->load($parameters);
    }

    /**
     *  Create users,profiles records and return the associated account.
     *
     *  @return self
     */
    public function handle()
    {
        $this->account = new Account;

        DB::transaction(function () {
            $account_parameters = collect($this->parameters)
                ->only($this->account->getFillable())
                ->toArray();

            $this->account
                ->fill($account_parameters)
                ->save();

            $profile_parameters = collect($this->parameters)
                ->only((new Profile)->getFillable())
                ->toArray();

            $profile = $this->account
                ->profile()
                ->create($profile_parameters);

            $this->account
                ->fill(['profile_id' => $profile->id])
                ->save(); // shouldn't this be automagical through ->account->profile()->create()
        });

        event(new AccountCreated($this->account));

        return $this;
    }

    /**
     *  Create and return an Account from provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Accounts\Models\Account
     */
    public static function From($parameters)
    {
        $builder = (new self($parameters))->handle();

        return $builder->account;
    }
}
