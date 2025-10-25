<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Responses\UserInertiaResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Edit extends Controller
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

        $user = $request->routeIs('my.*')
            ? $request->user()
            : $model::findOrFail($request->user);

        $this->authorize('edit', $user);

        return UserInertiaResponse::render($request, $user, 'users/Edit');
    }
}
