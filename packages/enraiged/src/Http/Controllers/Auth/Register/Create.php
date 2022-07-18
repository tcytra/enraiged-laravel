<?php

namespace Enraiged\Http\Controllers\Auth\Register;

use Enraiged\Http\Controllers\Auth\Controller;

class Create extends Controller
{
    /**
     *  Display the login view.
     *
     *  @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function __invoke()
    {
        if (!config('enraiged.auth.allow_registration')) {
            return redirect()->back();
        }

        $form = [
            'fields' => [
                'email' => null,
                'name' => null,
                'password' => null,
                'password_confirmation' => null,
            ],
            'uri' => route('register.store'),
        ];

        if (require_agreement()) {
            $form['fields']['agree'] = false;
        }

        return inertia('auth/Register', ['form' => $form]);
    }
}
