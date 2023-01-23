<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
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
