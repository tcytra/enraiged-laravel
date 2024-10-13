<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class Store extends Controller
{
    /**
     *  @param  \App\Http\Requests\Auth\RegisterRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = $request->handle();

        if ($user instanceof MustVerifyEmail) {
            $user->sendEmailVerificationNotification();

            $request->session()->put('success', 'Verification email sent');

        } else {
            $request->session()->put('success', 'Registration successful');
        }

        if (config('enraiged.auth.automated_login') === true) {
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        }

        return $user instanceof MustVerifyEmail
            ? back()->with('status', 201)
            : redirect($this->route('login'));
    }
}
