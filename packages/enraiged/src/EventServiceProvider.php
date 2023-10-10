<?php

namespace Enraiged;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var  array  The event listener mappings for the application. */
    protected $listen = [
    ];
  
    /**
     *  Register any events for your application.
     *
     *  @return void
     */
    public function boot()
    {
        \Enraiged\Agreements\Models\Agreement::observe(\Enraiged\Agreements\Observers\AgreementObserver::class);

        \Enraiged\Users\Models\InternetAddress::observe(\Enraiged\Users\Observers\InternetAddressObserver::class);

        \Enraiged\Profiles\Models\Profile::observe(\Enraiged\Profiles\Observers\ProfileObserver::class);

        \Enraiged\Users\Models\User::observe(\Enraiged\Users\Observers\UserObserver::class);
    }
}
