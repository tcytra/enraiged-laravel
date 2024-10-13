<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('auth:model', function () {
    dd(auth_model());
})->purpose('Display the current Authenticatable model');

Artisan::command('enraiged:auth', function () {
    dd(config('enraiged.auth'));
})->purpose('Display the enraiged.auth config');

Artisan::command('send:welcome {user}', function ($user) {
    $model = auth_model();
    $model::find($user)->notify(new \Enraiged\Users\Notifications\UserWelcome);
    $this->info('Welcome email sent.');
})->purpose('Send a welcome email to the specified user');
