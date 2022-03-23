<?php

namespace App\Http\Controllers\Auth\Register;

use Inertia\Inertia;

class Create extends \App\Http\Controllers\Auth\Controller
{
    /**
     *  Display the login view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('auth/Register');
    }
}
