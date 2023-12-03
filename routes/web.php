<?php

use Illuminate\Support\Facades\Route;

require base_path('routes/web/auth.php');
require base_path('routes/web/avatars.php');
require base_path('routes/web/files.php');
require base_path('routes/web/roles.php');
require base_path('routes/web/users.php');

Route::namespace('\App\Http\Controllers\State')
    ->group(function () {
        Route::get('api/app/state', 'AppState')->middleware(['auth', 'enraiged', 'verified'])->name('app.state');
        Route::get('api/guest/state', 'GuestState')->name('guest.state');
    });

Route::middleware(['auth', 'verified', 'enraiged'])
    ->get('/dashboard', '\App\Http\Controllers\Dashboard\Show')
    ->name('dashboard');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return inertia('Welcome');
});
