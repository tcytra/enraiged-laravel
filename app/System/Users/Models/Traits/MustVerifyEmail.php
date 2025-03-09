<?php

namespace App\System\Users\Models\Traits;

use App\System\Users\Notifications\VerifyEmailNotification;

trait MustVerifyEmail
{
    use \Illuminate\Auth\MustVerifyEmail;

    /**
     *  Send the email verification notification.
     *
     *  @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(
            (new VerifyEmailNotification)->locale($this->locale)
        );
    }
}
