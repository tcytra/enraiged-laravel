<?php

namespace App\System\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *  Determine if the notification should be sent.
     *
     *  @return bool
     */
    public function shouldSend(object $notifiable, string $channel): bool
    {
        return !app()->environment('testing');
    }

    /**
     *  Get the broadcast representation of the notification.
     *
     *  @return \Illuminate\Notifications\Messages\BroadcastMessage
     *  @todo   ..I guess
    public function toBroadcast()
    {
        return (new BroadcastMessage([
            'level' => 'info',
            'title' => __('Welcome'),
            'icon' => 'comment',
            'body' => __('Welcome to :app!', ['app' => config('app.name')]),
         ]))->onQueue('notifications');
    }*/

    /**
     *  Get the mail representation of the notification.
     *
     *  @param  mixed  $notifiable
     *  @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)->subject(__('Welcome!'));

        if (config('enraiged.app.mail_markdown') === true) {
            return $message
                ->markdown('mail.auth.welcome', ['user' => $notifiable]);
        }

        return $message
            ->greeting(__('Hello :name', ['name' => $notifiable->name]))
            ->line(__('Welcome to :app!', ['app' => config('app.name')]))
            ->action(__('View My Dashboard'), route('dashboard'))
            ->line(__('Feel free to contact the support team if you have questions or require assistance.'));
    }

    /**
     *  Get the notification's delivery channels.
     *
     *  @param  mixed  $notifiable
     *  @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
