<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Display the login component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $form = [
            'fields' => [
                'email' => app()->environment('local') ? env('ADMIN_EMAIL') : null,
                'password' => app()->environment('local') ? env('ADMIN_PASSWORD') : null,
                'remember' => false,
            ],
            'uri' => route('login.store'),
        ];

        return inertia('auth/Login', ['form' => $form]);
    }
}
