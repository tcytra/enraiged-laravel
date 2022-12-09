<?php

namespace Enraiged\Agreements;

use Enraiged\Agreements\Models\Agreement;
use Enraiged\Agreements\Observers\AgreementObserver;
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
    }
}
