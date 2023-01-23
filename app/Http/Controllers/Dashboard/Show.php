<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class Show extends Controller
{
    /**
     *  Display the dashboard component.
     *
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        return inertia('Dashboard');
    }
}
