<?php

namespace Enraiged\Accounts\Events;

use Enraiged\Accounts\Models\Account;
use Illuminate\Queue\SerializesModels;

class AccountCreated
{
    use SerializesModels;

    /** @var  object  The created account. */
    protected $account;

    /**
     *  Create an instance of the AccountCreated event.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     *  Handle an account updated event.
     *
     *  @return void
     *
    public function handle()
    {

    }*/
}
