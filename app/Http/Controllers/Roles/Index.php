<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Inertia\Response as InertiaResponse;

class Index extends Controller
{
    /**
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        $props = [];

        return inertia('roles/Index', $props);
    }
}
