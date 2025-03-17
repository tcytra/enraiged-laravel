<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

require 'web/auth.php';
require 'web/users.php';

Route::middleware(['auth', 'verified'])
    ->get('/dashboard', '\App\Http\Controllers\Dashboard\Show')
    ->name('dashboard');

Route::get('/', function () {
    // if (app()->environment('testing')) {
    //     return view('welcome');
    // }

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    if (config('enraiged.auth.force_guest_login') === true) {
        return redirect()->route('login');
    }

    return inertia('Welcome', [
        'allowLogin' => config('enraiged.auth.allow_login') === true,
        'allowRegistration' => config('enraiged.auth.allow_registration') === true,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
