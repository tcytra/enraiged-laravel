<?php

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Auth\Controller;
use App\Http\Requests\Auth\PasswordConfirmRequest;
use App\Providers\RouteServiceProvider;

class Store extends Controller
{
    /**
     *  Confirm the user's password.
     *
     *  @param  \App\Http\Requests\Auth\PasswordConfirmRequest  $request
     *  @return mixed
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(PasswordConfirmRequest $request)
    {
        $request->handle();

        if ($request->success) {
            $request->session()->put('auth.password_confirmed_at', time());
            $request->session()->put('success', 'Password confirmed.');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
