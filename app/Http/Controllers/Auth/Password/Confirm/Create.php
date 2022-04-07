<?php

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Show the confirm password view.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $form = [
            'fields' => [
                'email' => $request->user()->email,
                'password' => null,
            ],
            'uri' => route('password.confirm.store'),
        ];

        return inertia('auth/PasswordConfirm', ['form' => $form]);
    }
}
