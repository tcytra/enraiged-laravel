<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Accounts')
    ->group(function(){

        Route::get('accounts', 'Index')->name('accounts.index');

        Route::prefix('account')->as('account.')
            ->group(function(){
                Route::get('{account}/edit', 'Edit')->name('edit');
                Route::patch('{account}/update', 'Update')->name('update');
            });

        Route::middleware('password.confirm')
            ->get('my/account', 'Edit')
            ->name('my.account');

    });
