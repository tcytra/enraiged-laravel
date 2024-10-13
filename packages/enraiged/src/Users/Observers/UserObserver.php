<?php

namespace Enraiged\Users\Observers;

use Enraiged\Enums\Roles;
use Enraiged\Roles\Models\Role;
use Enraiged\Users\Models\User;
use Enraiged\Users\Notifications\UserLoginChange;
use Enraiged\Users\Notifications\UserWelcome;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

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
     *  Handle the User creating event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function creating(User $user)
    {
        if (is_null($user->role_id)) {
            if (($name = config('enraiged.auth.force_default_role')) && ($role = Role::find($name))) {
                $user->role_id = $role->id;
            } else
            if (config('enraiged.auth.force_lowest_role', false) === true) {
                $user->role_id = Role::lowest()->id;
            }
        }

        if ($user->role->is(Roles::Administrator)) {
            $user->verified_at = now();
        }
    }

    /**
     *  Handle the User creating event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function deleting(User $user)
    {
        if ($user->is_protected) {
            throw new ConflictHttpException(__('exceptions.user.protected'));
        }
    }

    /**
     *  Handle the User saving event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function saving(User $user)
    {
        if (is_null($user->language)) {
            $user->language = config('app.locale');
        }

        if (is_null($user->theme)) {
            $user->theme = config('enraiged.theme.color');
        }

        if (is_null($user->timezone)) {
            $user->timezone = config('enraiged.app.timezone');
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

    /**
     *  Handle the User updating event.
     *
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return void
     */
    public function updating(User $user)
    {
        if ($user->isDirty('password')) {
            $user->passwordHistory()
                ->create([
                    'password' => $user->getOriginal('password'),
                ]);
        }
    }
}
