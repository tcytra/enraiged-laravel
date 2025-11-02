<?php

namespace App\Http\Controllers\Auth\Password\Forgot;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the password reset link request view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        $props = [
            'allowLogin' => config('enraiged.auth.allow_login') === true,
        ];

        return inertia('auth/ForgotPassword', $props);
    }
}
