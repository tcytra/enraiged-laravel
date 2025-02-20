<?php

namespace Enraiged\Avatars;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     *  Bootstrap any application services.
     *
     *  @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'avatar' => Enraiged\Avatars\Models\Avatar::class,
        ]);
    }
}
