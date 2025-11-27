<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the login form.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        return inertia('auth/Login');
    }
}
