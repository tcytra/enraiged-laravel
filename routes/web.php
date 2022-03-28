<?php

use Illuminate\Support\Facades\Route;

/*
use App\Http\Resources\Auth\UserResource;
Route::get('auth/check', function(){
    return [
        'auth' => Auth::check(),
        'user' => Auth::check()
            ? UserResource::from(Auth::user())
        : null,
    ];
});
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//  \App\Http\Controllers\Account
Route::middleware(['auth', 'verified'])
    ->group(base_path('routes/web/account.php'));

//  \App\Http\Controllers\Auth
Route::namespace('Auth')
    ->group(base_path('routes/web/auth.php'));

//  \App\Http\Controllers\Dashboard
Route::middleware('auth')
    ->get('/', 'Dashboard\Show')
    ->name('dashboard');
