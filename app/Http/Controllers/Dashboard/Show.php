<?php

namespace App\Http\Controllers\Dashboard;

class Show extends \App\Http\Controllers\Controller
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
