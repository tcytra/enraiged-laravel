<?php

namespace Enraiged\Http\Controllers\Auth\Password;

use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Display the password reset form.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  string  $token
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, string $token)
    {
        $form = [
            'fields' => [
                'email' => $request->get('email'),
                'password' => null,
                'password_confirmation' => null,
                'token' => $token,
            ],
            'uri' => route('password.update'),
        ];

        return inertia('auth/PasswordReset', ['form' => $form]);
    }
}
