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

        $user = (new $model);

        $props = [
            'form' => $user->form($request)
                ->fieldIf('email', ['label' => 'Primary Email'], $user->allowSecondaryCredential)
                ->fieldIf('username', ['label' => 'Secondary Email or Username', 'type' => 'text'], $user->allowUsernameLogin)
                ->removeIf('username', !$user->allowSecondaryCredential)
                ->template(),
        ];

        return inertia('users/Create', $props);
    }
}
