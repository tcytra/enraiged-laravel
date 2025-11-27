<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the registration form.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        return inertia('auth/Register');
    }
}
