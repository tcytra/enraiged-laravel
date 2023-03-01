<?php

namespace Enraiged\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserWelcome extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     *  Determine if the notification should be sent.
     *
     *  @return bool
     */
    public function shouldSend(object $notifiable, string $channel): bool
    {
        return config('enraiged.auth.send_welcome_notification') === true;
    }

    /**
     *  Get the mail representation of the notification.
     *
     *  @param  mixed  $notifiable
     *  @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $config = (object) config('enraiged.notifications.welcome_notification');
        $message = (new MailMessage)->subject(__('Welcome!'));

        return property_exists($config, 'markdown')
            ? $message->markdown($config->markdown, ['user' => $notifiable])
            : $message
                ->greeting(__('Hello :name', ['name' => $notifiable->profile->first_name]))
                ->action(__('View My Dashboard'), route('dashboard'))
                ->line(__('Welcome to :app!', ['app' => config('app.name')]))
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
        return config('enraiged.notifications.welcome_notification.channels');
    }
}
