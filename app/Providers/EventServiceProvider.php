<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     *  Bootstrap the blueprint services.
     *
     *  @return void
     */
    public function boot()
    {
        \App\System\Users\Models\User::observe(\App\System\Users\Observers\UserObserver::class);
    }
}
