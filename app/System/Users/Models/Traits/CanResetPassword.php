<?php

namespace App\System\Users\Models\Traits;

use App\System\Users\Notifications\ResetPasswordNotification;

trait CanResetPassword
{
    use \Illuminate\Auth\Passwords\CanResetPassword;

    /**
     *  Send the password reset notification.
     *
     *  @param  string  $token
     *  @return void
     */
    public function sendPasswordResetNotification(#[\SensitiveParameter] $token)
    {
        $this->notify(
            (new ResetPasswordNotification($token))->locale($this->locale)
        );
    }
}
