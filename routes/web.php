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

Route::namespace('\Enraiged\Http\Controllers\State')
    ->middleware(['auth', 'enraiged', 'verified'])
    ->group(function () {
        Route::get('api/app/state', 'AppState')->name('app.state');
    });

//  /api/app/state
//  /api/guest/state

//  \Enraiged\Http\Controllers\Accounts
Route::middleware(['auth', 'enraiged', 'verified'])
    ->group(base_path('packages/enraiged/routes/accounts.php'));

//  \Enraiged\Http\Controllers\Avatars
Route::middleware(['auth', 'enraiged', 'verified'])
    ->group(base_path('packages/enraiged/routes/avatars.php'));

//  \Enraiged\Http\Controllers\Files
Route::middleware(['auth', 'enraiged', 'verified'])
    ->group(base_path('packages/enraiged/routes/files.php'));

//  \Enraiged\Http\Controllers\Dashboard
Route::middleware(['auth', 'enraiged'])
    ->get('/', '\Enraiged\Http\Controllers\Dashboard\Show')
    ->name('dashboard');
