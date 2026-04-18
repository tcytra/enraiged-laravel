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

        $status = $user->isMyself
            ? 205
            : 200;

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'message' => $request->message(),
                    'redirect' => $request->has('_referer')
                        ? $request->get('_referer')
                        : route('users.index'),
                    'success' => true,
                ], $status);
        }

        return $user->isMyself
            ? redirect()->route('my.profile.edit')
            : redirect()->route('users.index');
    }
}
