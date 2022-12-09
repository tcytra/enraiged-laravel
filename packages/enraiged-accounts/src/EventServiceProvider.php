<?php

namespace Enraiged\Accounts;

use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Observers\AccountObserver;
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
        Account::observe(AccountObserver::class);
    }
}
