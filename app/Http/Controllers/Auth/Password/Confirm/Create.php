<?php

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Create extends Controller
{
    /**
     *  Show the confirm password view.
     *
     *  @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        $form = [
            'fields' => [
                'email' => $request->user()->email,
                'password' => null,
            ],
            'uri' => '/confirm-password',
        ];

        return inertia('auth/PasswordConfirm', ['form' => $form]);
    }
}
