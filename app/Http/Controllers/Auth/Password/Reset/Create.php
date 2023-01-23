<?php

namespace App\Http\Controllers\Auth\Password\Reset;

use App\Http\Controllers\Controller;

class Create extends Controller
{
    /**
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        $form = [
            'fields' => [
                'email' => null,
            ],
            'uri' => route('password.email'),
        ];

        return inertia('auth/PasswordForgot', ['form' => $form]);
    }
}
