<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the login view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        $props = [
            'allowUsernameLogin' => config('enraiged.auth.allow_secondary_credential') === true
                && config('enraiged.auth.allow_username_login') === true,
            'allowRegistration' => config('enraiged.auth.allow_registration') === true,
            'allowPasswordReset' => config('enraiged.auth.allow_password_reset') === true,
        ];

        return inertia('auth/Login', $props);
    }
}
