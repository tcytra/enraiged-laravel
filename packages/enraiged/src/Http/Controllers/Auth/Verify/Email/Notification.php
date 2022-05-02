<?php

namespace Enraiged\Http\Controllers\Auth\Verify\Email;

use App\Providers\RouteServiceProvider;
use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Notification extends Controller
{
    /**
     *  Send a new email verification notification.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
