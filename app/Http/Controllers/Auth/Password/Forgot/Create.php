<?php

namespace App\Http\Controllers\Auth\Password\Forgot;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the password reset link request form.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        return inertia('auth/ForgotPassword');
    }
}
