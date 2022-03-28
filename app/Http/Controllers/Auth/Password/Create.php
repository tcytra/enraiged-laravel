<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Display the password reset form.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\View\View
     */
    public function __invoke(Request $request, $token)
    {
        $form = [
            'fields' => [
                'email' => $request->get('email'),
                'password' => null,
                'password_confirmation' => null,
                'token' => $token,
            ],
            'uri' => '/reset-password',
        ];

        return inertia('auth/PasswordReset', ['form' => $form]);
    }
}
