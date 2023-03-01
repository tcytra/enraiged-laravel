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
            $request->session()->put('success', 'Email sent');

            return redirect()
                ->back()
                ->with(['status' => 201]);
        }

        $request->session()->put('success', 'Registration successful');

        if (config('enraiged.auth.automated_login') === true && !config('enraiged.auth.must_verify_email')) {
            Auth::login($user);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
