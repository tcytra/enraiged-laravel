<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Response as InertiaResponse;

class Index extends Controller
{
    use AuthorizesRequests;

    /**
     *  @return \Inertia\Response
     */
    public function __invoke(): InertiaResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('index', $model);

        $props = [];

        return inertia('users/Index', $props);
    }
}
