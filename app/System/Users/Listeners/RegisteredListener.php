<?php

namespace App\System\Users\Listeners;

use Illuminate\Auth\Events\Registered;

class RegisteredListener
{
    /**
     *  Handle the user registered event.
     *
     *  @return void
     */
    public function handle(Registered $event): void
    {
        //  we will trigger the notification here if the system *does not* require email verification
        if (config('enraiged.auth.must_verify_email') !== true) {
            $event->user->sendWelcomeNotification();
        }
    }
}
