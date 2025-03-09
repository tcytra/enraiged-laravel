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
            'canRegister' => config('enraiged.auth.allow_registration') === true,
            'canResetPassword' => config('enraiged.auth.allow_password_reset') === true,
            'status' => session('status'),
        ];

        return inertia('Auth/Login', $props);
    }
}
