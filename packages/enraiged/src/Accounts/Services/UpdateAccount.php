<?php

namespace Enraiged\Accounts\Services;

use Enraiged\Accounts\Models\Account;
use Illuminate\Support\Facades\DB;

class UpdateAccount
{
    use Traits\LoadParameters;

    /** @var  object  The Account model. */
    protected $account;

    /** @var  array  The provided parameters. */
    protected $parameters;

    /**
     *  Create an instance of the UpdateAccount service.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(Account $account, array $parameters)
    {
        $this->account = $account;

        $this->load($parameters);
    }

    /**
     *  Update the users,profiles records and return the associated account.
     *
     *  @return self
     */
    public function handle()
    {
        DB::transaction(function () {
            $account_parameters = collect($this->parameters)
                ->only($this->account->getFillable())
                ->toArray();

            $this->account->update($account_parameters);

            $profile_parameters = collect($this->parameters)
                ->only($this->account->profile->getFillable())
                ->toArray();

            $this->account->profile->update($profile_parameters);

            $this->account->user->touch();
        });

        return $this;
    }

    /**
     *  Update and return an Account from provided parameters.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @param  array   $parameters
     *  @return \Enraiged\Accounts\Models\Account
     */
    public static function From(Account $account, array $parameters)
    {
        $builder = (new self($account, $parameters))->handle();

        return $builder->account;
    }
}
