<?php

use Illuminate\Support\Facades\Route;

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

//  \App\Http\Controllers\Accounts
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/accounts.php'));

//  \App\Http\Controllers\Avatars
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/avatars.php'));

//  \App\Http\Controllers\Files
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/files.php'));

//  \App\Http\Controllers\Auth
Route::namespace('Auth')
    ->group(base_path('packages/enraiged/routes/auth.php'));

//  \App\Http\Controllers\Dashboard
Route::middleware('auth')
    ->get('/', 'Dashboard\Show')
    ->name('dashboard');
