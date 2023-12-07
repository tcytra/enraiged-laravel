<?php

namespace Enraiged\Users\Traits;

use Enraiged\Users\Models\User;

trait Messages
{
    /**
     *  Prepare and return an array of the available page messages.
     *
     *  @return array
     */
    private function messages(User $user)
    {
        $messages = [];

        if ($user->deleted_at) {
            $datetime = date_create(datetimezone($user->deleted_at), new \DateTimeZone(timezone()));
            $formatter = new \IntlDateFormatter(language(), \IntlDateFormatter::FULL, \IntlDateFormatter::SHORT);
            $message = __('This user was deleted on :deleted', ['deleted' => $formatter->format($datetime)]);

            array_push($messages, message($message, 'error'));

            return $messages;
        }

        if ($user->isMyself) {
            array_push($messages, message('This is your personal user profile.'));
        } else

        if (user()->isAdministrator) {
            array_push($messages, message('You are viewing this user profile as an administrator.', 'warn'));
        }

        return $messages;
    }
}
