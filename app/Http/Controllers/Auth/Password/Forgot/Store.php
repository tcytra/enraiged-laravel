<?php

namespace App\Http\Controllers\Auth\Password\Forgot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\Forgot\Request as PasswordForgotRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class Store extends Controller
{
    /**
     *  Handle an incoming password reset link request.
     *
     *  @param  \App\Http\Requests\Auth\Password\Forgot\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(PasswordForgotRequest $request): RedirectResponse
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
