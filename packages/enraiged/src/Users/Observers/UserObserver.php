<?php

namespace Enraiged\Users\Observers;

use App\Support\Enums\Roles;
use Enraiged\Roles\Models\Role;
use Enraiged\Users\Models\User;
use Enraiged\Users\Notifications\UserLoginChange;
use Enraiged\Users\Notifications\UserWelcome;

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
        $user->notify(new UserWelcome);

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
     *  Handle the User created event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function creating(User $user)
    {
        if (is_null('role_id') && config('enraiged.auth.force_lowest_role')) {
            $user->role_id = Role::lowest()->id;
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
