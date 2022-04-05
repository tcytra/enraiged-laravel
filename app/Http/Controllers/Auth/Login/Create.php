<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Display the login component.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $form = [
            'fields' => [
                'email' => 'administrator@demo.dev',
                'password' => 'letmein!',
                'remember' => false,
            ],
            'uri' => route('login.store'),
        ];

        return inertia('auth/Login', ['form' => $form]);
    }
}
