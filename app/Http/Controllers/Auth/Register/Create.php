<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the registration view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        $props = [
            'canLogin' => config('enraiged.auth.allow_login') === true,
        ];

        return inertia('Auth/Register', $props);
    }
}
