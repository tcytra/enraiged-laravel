<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\Request as LoginRequest;
use Illuminate\Http\RedirectResponse;

class Store extends Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @param  \App\Http\Requests\Auth\Login\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
