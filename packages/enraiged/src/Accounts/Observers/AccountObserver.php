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

        $require_agreement = $account->user->must_agree_to_terms === true
            && $account->user->has_agreed_to_terms === false;

        if ($require_agreement) {
            $config = config('enraiged.auth.must_agree_to_terms');

            $automatic_agreements = gettype($config) === 'array'
                && key_exists('automatic_agreements', $config)
                && $config['automatic_agreements'] === true;

            if ($automatic_agreements) {
                $account->user->acceptAgreements();
            }
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

        $login_change_notification = $changed->count()
            && (!$updater || $updater->role->isNot(Roles::Administrator))
            && config('enraiged.notifications.account_login_change');

        if ($login_change_notification) {
            $account->user->notify(new AccountLoginChange());
        }
    }
}
