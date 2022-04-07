<?php

namespace Enraiged\Accounts\Events;

use Enraiged\Accounts\Models\Account;
use Illuminate\Queue\SerializesModels;

class AccountUpdated
{
    use SerializesModels;

    /** @var  object  The updated account. */
    protected $account;

    /** @var  array  The changes made to the account. */
    protected $changes;

    /**
     *  Create an instance of the AccountUpdated event.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->changes = $model->getChanges();
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
