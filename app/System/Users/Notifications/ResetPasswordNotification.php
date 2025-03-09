<?php

namespace App\System\Users\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification implements ShouldQueue
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
        $resetUrl = $this->resetUrl($notifiable);

        $message = (new MailMessage)
            ->subject(__('Reset Password'));

        if (config('enraiged.app.mail_markdown') === true) {
            return $message
                ->markdown('mail.auth.reset-password', ['url' => $resetUrl, 'user' => $notifiable]);
        }

        return $message
            ->greeting(__('Hello :name', ['name' => $notifiable->name]))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->action(__('Reset Password'), $resetUrl)
            ->line(__('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(__('If you did not request a password reset, no further action is required.'));
    }
}
