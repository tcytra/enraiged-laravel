<?php

namespace App\System\Users\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *  Build the mail representation of the notification.
     *
     *  @param  mixed  $notifiable
     *  @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        $message = (new MailMessage)->subject(__('Welcome!'));

        if (config('enraiged.app.mail_markdown') === true) {
            return $message
                ->markdown('mail.auth.verify-email', ['url' => $verificationUrl, 'user' => $notifiable]);
        }

        return $message
            ->greeting(__('Hello :name', ['name' => $notifiable->name]))
            ->line(__('Please click the button below to verify your email address.'))
            ->action(__('Verify Email Address'), $verificationUrl)
            ->line(__('If you did not create an account, no further action is required.'));
    }
}
