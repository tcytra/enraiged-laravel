<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Show extends Controller
{
    /**
     *  Display the dashboard component.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        return inertia('Dashboard');
    }
}
