<?php

namespace Enraiged;

use Enraiged\Agreements\Models\Agreement;
use Enraiged\Agreements\Observers\AgreementObserver;
use Enraiged\Users\Models\InternetAddress;
use Enraiged\Users\Models\User;
use Enraiged\Users\Observers\IpAddressObserver;
use Enraiged\Users\Observers\UserObserver;
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
        Agreement::observe(AgreementObserver::class);

        InternetAddress::observe(IpAddressObserver::class);

        User::observe(UserObserver::class);
    }
}
