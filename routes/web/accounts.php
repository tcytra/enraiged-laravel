<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Accounts')
    ->group(function(){

        Route::prefix('accounts')
            ->as('accounts.')
            ->group(function () {
                Route::get('', 'Index')->name('index');
                Route::get('{account}', 'Show')->name('show');
                Route::get('{account}/edit', 'Edit')->name('edit');
                Route::patch('{account}/update', 'Update')->name('update');
            });

        Route::prefix('api/accounts')
            ->as('accounts.')
            ->group(function () {
                Route::namespace('Index')
                    ->prefix('index')
                    ->as('index.')
                    ->group(function () {
                        Route::get('data', 'Data')->name('data');
                        Route::get('export', 'Export')->name('export');
                    });
                Route::delete('{account}', 'Destroy')->name('destroy');
            });

        Route::prefix('my')->as('my.')
            ->group(function () {
                Route::get('account', 'Show')->name('account');
                Route::get('account/edit', 'Edit')->middleware('password.confirm')->name('account.edit');
            });

    });
