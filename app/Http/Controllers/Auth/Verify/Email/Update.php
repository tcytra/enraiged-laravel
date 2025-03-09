<?php

namespace App\Http\Controllers\Auth\Verify\Email;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class Update extends Controller
{
    /**
     *  Mark the authenticated user's email address as verified.
     *
     *  @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()
                ->intended($this->route('dashboard').'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()
            ->intended($this->route('dashboard').'?verified=1');
    }
}
