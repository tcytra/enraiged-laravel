<?php

namespace Enraiged\Accounts\Observers;

use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Notifications\AccountIntroduction;
use Enraiged\Accounts\Notifications\AccountLoginChange;
use Enraiged\Roles\Enums\Roles;

class AccountObserver
{
    /**
     *  Handle the Account created event.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return void
     */
    public function created(Account $account)
    {
        if (config('enraiged.notifications.account_introduction')) {
            $account->user->notify(new AccountIntroduction());
        }
    }

    /**
     *  Handle the Account updated event.
     *
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return void
     */
    public function updated(Account $account)
    {
        $changed = collect($account->getChanges())
            ->only(['email', 'username', 'password']);

        $updater = request()->user();

        if ($changed->count()
            && (!$updater || $updater->role->isNot(Roles::Administrator))
            && config('enraiged.notifications.account_login_change')) {
            $account->user->notify(new AccountLoginChange());
        }
    }
}
