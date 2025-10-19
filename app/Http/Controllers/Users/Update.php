<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  Update the user's profile information.
     *
     *  @param  \App\Http\Requests\Users\UpdateRequest  $request
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): JsonResponse|RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->routeIs('my.*')
            ? $request->user()
            : $model::findOrFail($request->user);

        $this->authorize('update', $user);

        $request->updateUser($user);

        $status = $request->user()->id === $user->id
            ? 205
            : 200;

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'message' => $request->message(),
                    'success' => true,
                ], $status);
        }

        return $request->routeIs('my.*')
            ? redirect()->route('my.profile.edit')->with('status', 'verification-link-sent')
            : redirect()->route('users.edit', ['user' => $user->id]);
    }
}
