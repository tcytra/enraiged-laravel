<?php

namespace Enraiged\Accounts\Services;

use Enraiged\Accounts\Events\AccountUpdated;
use Enraiged\Accounts\Models\Account;

class UpdateAccount
{
    use Traits\LoadParameters,
        Traits\ModelAttributes;

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
     *  Update the User,Profile records and return the associated Account.
     *
     *  @return self
     */
    public function handle()
    {
        $this->account->profile->update(
            collect($this->parameters)
                ->only($this->getProfileAttributes())
                ->toArray()
        );

        $this->account->user->update(
            collect($this->parameters)
                ->only($this->getAccountAttributes())
                ->toArray()
        );

        event(new AccountUpdated($this->account));

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
