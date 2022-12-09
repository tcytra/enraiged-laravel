<?php

namespace Enraiged\Exports\Notifications;

use Enraiged\Exports\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;

//use Illuminate\Notifications\Messages\BroadcastMessage;
//use Illuminate\Notifications\Messages\MailMessage;
//use Illuminate\Notifications\Notification;

class ExportDone extends Notification implements ShouldQueue
{
    use Dispatchable, Queueable;

    private $export;

    private $subject;

    private $user;

    public function __construct(User $user, Export $export, ?string $subject = null)
    {
        $this->export = $export;
        $this->subject = $subject;
        $this->user = $user;
    }

    public function via()
    {
        return []; // ['mail', 'broadcast', 'database'];
    }

    public function toBroadcast()
    {
        
    }

    public function toMail($notifiable)
    {
        
    }

    public function toArray()
    {
        
    }
}
