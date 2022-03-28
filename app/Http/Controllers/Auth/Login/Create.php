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
                'email' => 'administrator@enraiged.dev',
                'password' => 'letmein!',
                'remember' => false,
            ],
            'uri' => '/login',
        ];

        return inertia('auth/Login', ['form' => $form]);
    }
}
