<?php

namespace Enraiged\Http\Controllers\Auth\Password\Reset;

use Enraiged\Http\Controllers\Auth\Controller;
use Enraiged\Http\Requests\Auth\PasswordForgotRequest;

class Store extends Controller
{
    /**
     *  Handle an incoming password reset link request.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(PasswordForgotRequest $request)
    {
        $request->handle();

        if ($request->success) {
            $request->session()->put('success', 'Email sent');

            return redirect()
                ->back()
                ->with(['status' => 200]);
        }

        return inertia('auth/PasswordForgot', [
                'errors' => [
                    'email' => __($request->status),
                ],
            ]);
    }
}
