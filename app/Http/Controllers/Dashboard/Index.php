<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;

class Index extends \App\Http\Controllers\Controller
{
    /**
     *  Display the dashboard view.
     *
     *  @return \Inertia\Response
     */
    public function __invoke()
    {
        return Inertia::render('dashboard/Index');
    }
}
