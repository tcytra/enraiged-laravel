<?php

namespace App\System\Users\Listeners;

use Illuminate\Auth\Events\Verified;

class VerifiedListener
{
    /**
     *  Handle the user verified event.
     *
     *  @return void
     */
    public function handle(Verified $event): void
    {
        //  we will trigger the notification here if the system *does* require email verification
        if (config('enraiged.auth.must_verify_email') === true) {
            $event->user->sendWelcomeNotification();
        }
    }
}
