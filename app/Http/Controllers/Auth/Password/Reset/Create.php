<?php

namespace App\Http\Controllers\Auth\Password\Reset;

use App\Http\Controllers\Controller;

class Create extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        $form = [
            'fields' => [
                'email' => null,
            ],
            'uri' => '/forgot-password',
        ];

        return inertia('auth/PasswordForgot', ['form' => $form]);
    }
}
