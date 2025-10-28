<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class Store extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\CreateRequest  $request
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request): JsonResponse|RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('store', $model);

        $user = $request->createUser(new $model);

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'message' => $request->message(),
                    'redirect' => $request->has('_referer')
                        ? $request->get('_referer')
                        : $this->route('users.show', ['user' => $user->id]),
                    'success' => true,
                ]);
        }

        return $request->has('_referer')
            ? redirect($request->get('_referer'))
            : redirect()->route('users.show', ['user' => $user->id], 302);
    }
}
