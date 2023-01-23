<?php

use Illuminate\Support\Facades\Route;

require base_path('routes/web/api.php');
require base_path('routes/web/auth.php');
require base_path('routes/web/avatars.php');
require base_path('routes/web/files.php');
require base_path('routes/web/users.php');
require base_path('routes/web/users.protected.php');

Route::middleware(['auth', 'verified', 'enraiged'])
    ->get('/dashboard', '\App\Http\Controllers\Dashboard\Show')
    ->name('dashboard');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return inertia('Welcome');
});
