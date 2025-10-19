<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Resources\UserFormResource;
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

        return inertia('users/Edit', [
            'allowSecondaryCredential' => $user->allowSecondaryCredential,
            'allowSelfDelete' => $user->allowSelfDelete,
            'allowUsernameLogin' => $user->allowUsernameLogin,
            'isMyProfile' => $user->id === $request->user()->id,
            'isProtectedUser' => $user->isProtected,
            'mustVerifyEmail' => $user->mustVerifyEmail,
            'mustVerifySecondary' => $user->mustVerifySecondary,
            'status' => session('status'),
            'user' => new UserFormResource($user),
        ]);
    }
}
