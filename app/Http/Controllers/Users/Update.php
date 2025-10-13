<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Update\Request as UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class Update extends Controller
{
    /**
     *  Update the user's profile information.
     *
     *  @param  \App\Http\Requests\Users\Update\Request  $request
     *  @param  string|null  $attribute = null
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): JsonResponse|RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        $user->update($request->validated());

        if ($request->is('api/*')) {
            return response()
                ->json([
                    'message' => $request->message(),
                    'success' => true,
                ]);
        }

        return $request->is('my/*')
            ? redirect()->route('my.profile.edit')->with('status', 'verification-link-sent')
            : redirect()->route('users.edit', ['user' => $user->id]);
    }
}
