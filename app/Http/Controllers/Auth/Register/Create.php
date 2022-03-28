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
        if (!config('auth.allow_registration')) {
            return redirect()->back();
        }

        $form = [
            'fields' => [
                'agree' => true,
                'email' => 'strawberry@fields.com',
                'first_name' => 'Strawberry Fields',
                'password' => 'changeme',
                'password_confirmation' => 'changeme',
            ],
            'uri' => '/register',
        ];

        return inertia('auth/Register', ['form' => $form]);
    }
}
