<?php

namespace Enraiged\Users\Observers;

use App\Auth\Enums\Roles;
use Enraiged\Users\Models\User;
use Enraiged\Users\Notifications\UserIntroduction;
use Enraiged\Users\Notifications\UserLoginChange;

class UserObserver
{
    /**
     *  Handle the User created event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function created(User $user)
    {
        if (config('enraiged.notifications.user_introduction')) {
            $user->notify(new UserIntroduction());
        }

        $require_agreement = $user->must_agree_to_terms === true
            && $user->has_agreed_to_terms === false;

        if ($require_agreement) {
            $config = config('enraiged.auth.must_agree_to_terms');

            $automatic_agreements = gettype($config) === 'array'
                && key_exists('automatic_agreements', $config)
                && $config['automatic_agreements'] === true;

            if ($automatic_agreements) {
                $user->acceptAgreements();
            }
        }
    }

    /**
     *  Handle the User updated event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function updated(User $user)
    {
        $changed = collect($user->getChanges())
            ->only(['email', 'username', 'password']);

        $updater = request()->user();

        $login_change_notification = $changed->count()
            && (!$updater || $updater->role->isNot(Roles::Administrator))
            && config('enraiged.notifications.user_login_change');

        if ($login_change_notification) {
            $user->notify(new UserLoginChange());
        }
    }
}
