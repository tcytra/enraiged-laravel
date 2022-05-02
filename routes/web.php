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

//  \Enraiged\Http\Controllers\Accounts
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/accounts.php'));

//  \Enraiged\Http\Controllers\Avatars
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/avatars.php'));

//  \Enraiged\Http\Controllers\Files
Route::middleware(['auth', 'verified'])
    ->group(base_path('packages/enraiged/routes/files.php'));

//  \Enraiged\Http\Controllers\Auth
Route::namespace('\Enraiged\Http\Controllers\Auth')
    ->group(base_path('packages/enraiged/routes/auth.php'));

//  \Enraiged\Http\Controllers\Dashboard
Route::middleware('auth')
    ->get('/', '\Enraiged\Http\Controllers\Dashboard\Show')
    ->name('dashboard');
