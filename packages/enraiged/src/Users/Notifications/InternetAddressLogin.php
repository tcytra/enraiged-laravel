<?php

namespace Enraiged\Users\Notifications;

use Enraiged\Users\Models\InternetAddress;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternetAddressLogin extends Notification implements ShouldQueue
{
    use Queueable;

    protected $address;

    /**
     *  Create an instance of the InternetAddressLogin notification.
     *
     *  @param  \Enraiged\Users\Models\InternetAddress  $address
     */
    public function __construct(InternetAddress $address)
    {
        $this->address = $address;
    }

    /**
     *  Determine if the notification should be sent.
     *
     *  @param  mixed   $notifiable
     *  @param  string  $channel
     *  @return bool
     *  @todo   Reference the preference.. when it's done... re: User::$notification_channels
     */
    public function shouldSend($notifiable, $channel)
    {
        return in_array($channel, $notifiable->notification_channels)
            && $notifiable->ipAddresses->count() > 1;
    }

    /**
     *  Get the mail representation of the notification.
     *
     *  @param  mixed  $notifiable
     *  @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting(__('Hello :name', ['name' => $notifiable->profile->first_name]))
            ->line(__('We have detected a login with your account from a new internet address:'))
            ->line($this->address->ip())
            ->line(__('If this login is unexpected, please take immediate action by changing your password.'))
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
        return config('enraiged.notifications.internet_address_login.channels');
    }
}
