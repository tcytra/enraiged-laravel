<?php

namespace Enraiged\Http\Controllers\Auth\Password\Confirm;

use App\Providers\RouteServiceProvider;
use Enraiged\Http\Controllers\Auth\Controller;
use Enraiged\Http\Requests\Auth\PasswordConfirmRequest;

class Store extends Controller
{
    /**
     *  Confirm the user's password.
     *
     *  @param  \Enraiged\Http\Requests\Auth\PasswordConfirmRequest  $request
     *  @return \Illuminate\Http\RedirectResponse|\Inertia\Response
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
