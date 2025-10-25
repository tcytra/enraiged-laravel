<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the user's profile forms.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('create', $model);

        $props = [
        ];

        return inertia('users/Create', $props);
    }
}
