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
            'allowLogin' => config('enraiged.auth.allow_login') === true,
            'allowSecondaryCredential' => config('enraiged.auth.allow_secondary_credential') === true,
            'allowUsernameLogin' => config('enraiged.auth.allow_username_login') === true,
        ];

        return inertia('auth/Register', $props);
    }
}
