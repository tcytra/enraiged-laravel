<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;

class Store extends \App\Http\Controllers\Auth\Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}

