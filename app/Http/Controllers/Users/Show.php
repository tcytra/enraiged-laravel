<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Enums\Roles;
use Enraiged\Users\Responses\UserInertiaResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Show extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');
        $roles = config('auth.providers.roles.enum', Roles::class);

        $user = $request->routeIs('my.*')
            ? $request->user()
            : ($request->user()->role->is($roles::find('Administrator'))
                ? $model::withTrashed()->findOrFail($request->user)
                : $model::findOrFail($request->user));

        $this->authorize('show', $user);

        return UserInertiaResponse::render($request, $user, 'users/Show');
    }
}
