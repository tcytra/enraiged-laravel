<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

//  \Enraiged\Http\Controllers\Auth
Route::namespace('\Enraiged\Http\Controllers\Auth')
    ->group(base_path('packages/enraiged/routes/auth.php'));

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/

//  \Enraiged\Http\Controllers\State
Route::namespace('\Enraiged\Http\Controllers\State')
    ->group(function () {
        Route::get('api/app/state', 'AppState')
            ->middleware(['auth', 'enraiged', 'verified'])
            ->name('app.state');
        Route::get('api/guest/state', 'GuestState')
            ->name('guest.state');
    });

//  \Enraiged\Http\Controllers\Accounts
Route::middleware(['auth', 'verified', 'enraiged'])
    ->group(base_path('packages/enraiged/routes/accounts.php'));
Route::middleware(['auth', 'verified', 'password.confirm', 'enraiged'])
    ->group(base_path('packages/enraiged/routes/accounts.protected.php'));

//  \Enraiged\Http\Controllers\Avatars
Route::middleware(['auth', 'verified', 'enraiged'])
    ->group(base_path('packages/enraiged/routes/avatars.php'));

//  \Enraiged\Http\Controllers\Files
Route::middleware(['auth', 'verified', 'enraiged'])
    ->group(base_path('packages/enraiged/routes/files.php'));

//  \Enraiged\Http\Controllers\Dashboard
Route::middleware(['auth', 'verified', 'enraiged'])
    ->get('/', '\Enraiged\Http\Controllers\Dashboard\Show')
    ->name('dashboard');
