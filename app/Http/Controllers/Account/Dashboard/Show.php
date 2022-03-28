<?php

namespace App\Http\Controllers\Account\Dashboard;

use App\Http\Controllers\Controller;

class Show extends Controller
{
    /**
     *  Display the account dashboard component.
     *
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        return inertia('account/Dashboard');
    }
}
