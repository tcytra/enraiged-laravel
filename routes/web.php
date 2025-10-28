<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

require 'web/auth.php';
require 'web/avatars.php';
require 'web/files.php';
require 'web/permissions.php';
require 'web/users.php';

//  Handle a request to display the dashboard.
Route::middleware(['auth', 'verified'])
    ->get('/dashboard', '\App\Http\Controllers\Dashboard\Show')
    ->name('dashboard');

//  Handle a request to return the current app state.
Route::get('app/state/{only?}', '\App\Http\Controllers\StateController')
    ->where('only', 'auth|menu|meta')
    ->name('app.state');

//  Handle a request to the app root url.
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    if (config('enraiged.auth.force_guest_login') === true) {
        return redirect()->route('login');
    }

    return inertia('Welcome', [
        'allowLogin' => config('enraiged.auth.allow_login') === true,
        'allowRegistration' => config('enraiged.auth.allow_registration') === true,
        'enraigedVersion' => config('enraiged.version'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
