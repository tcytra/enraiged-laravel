<?php

namespace App\Account\Events;

use App\Account\Models\Account;
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
     *  @param  \App\Account\Models\Account  $account
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
     */
    public function handle()
    {
        $changed = collect($this->changes);

        if ($changed->keys()->contains('email')) {
        }

        if ($changed->keys()->contains('password')) {
        }

        //  todo: do something!
    }
}
