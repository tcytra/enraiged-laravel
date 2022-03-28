<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Auth\Controller;

class Create extends Controller
{
    /**
     *  Display the login view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        $form = [
            'fields' => [
                'agree' => false,
                'email' => null, // 'strawberry@fields.com',
                'first_name' => null, // 'Strawberry Fields',
                'password' => null, // 'changeme',
                'password_confirmation' => null, // 'changeme',
            ],
            'uri' => '/register',
        ];

        return inertia('auth/Register', ['form' => $form]);
    }
}
