<?php

namespace App\Providers;

//use Enraiged\Accounts\Events\AccountCreated;
//use Enraiged\Accounts\Events\AccountUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        /*
        Event::listen(AccountCreated::class, function (AccountCreated $event) {
            //  todo: do something!
        });

        Event::listen(AccountUpdated::class, function (AccountUpdated $event) {
            $changed = collect($event->changes);

            if ($changed->keys()->contains('email')) {
            }

            if ($changed->keys()->contains('password')) {
            }

            //  todo: do something!
        });
        */
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
