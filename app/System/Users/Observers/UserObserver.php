<?php

namespace App\System\Users\Observers;

use App\System\Users\Models\User;
use App\System\Users\Notifications\LoginChangeNotification;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UserObserver
{
    /**
     *  Handle the User creating event.
     *
     *  @param  \App\System\Users\Models\User  $user
     *  @return void
     *
     *  @throws ConflictHttpException
     */
    public function deleting(User $user): void
    {
        if ($user->is_protected) {
            throw new ConflictHttpException(__('exceptions.user.protected'));
        }
    }

    /**
     *  Handle the User saving event.
     *
     *  @param  \App\System\Users\Models\User  $user
     *  @return void
     */
    public function saving(User $user)
    {
        if (is_null($user->locale)) {
            $user->locale = config('app.locale');
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

        $login_change_notification = $changed->count()
            && config('enraiged.auth.send_login_change_notification');

        if ($login_change_notification) {
            $user->notify(
                (new LoginChangeNotification)->locale($user->locale)
            );
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
        if (config('enraiged.passwords.history') !== false && $user->isDirty('password')) {
            $user->passwordHistory()
                ->create(['password' => $user->getOriginal('password')]);
        }
    }
}
