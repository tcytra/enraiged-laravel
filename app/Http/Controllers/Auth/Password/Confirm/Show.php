<?php

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Show extends Controller
{
    /**
     *  Show the confirm password view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        return inertia('auth/ConfirmPassword');
    }
}
