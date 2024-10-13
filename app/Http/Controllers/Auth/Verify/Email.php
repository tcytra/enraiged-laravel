<?php

namespace App\Http\Controllers\Auth\Verify;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Enraiged\Users\Notifications\UserWelcome;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class Email extends Controller
{
    /**
     *  @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            $request->user()->notify(new UserWelcome);
        }

        $request->session()->put('success', 'Verification successful.');

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
