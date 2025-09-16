<?php

namespace Enraiged\Exports\Notifications;

use Enraiged\Exports\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;

class ExportComplete extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var  Export  The completed export model. */
    private $export;

    /**
     *  Create an instance of the ExportComplete notification.
     *
     *  @param  \Enraiged\Exports\Models\Export  $export
     *  @return void
     */
    public function __construct(Export $export)
    {
        $this->export = $export;
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
            ->line(__('Your requested export has completed processing.'))
            ->line($this->export->file->name)
            ->line(__('The file is available for download from your Files page.'));
    }

    /**
     *  Get the notification's delivery channels.
     *
     *  @param  mixed  $notifiable
     *  @return array
     */
    public function via($notifiable)
    {
        return config('enraiged.notifications.export_completed.channels');
    }
}
