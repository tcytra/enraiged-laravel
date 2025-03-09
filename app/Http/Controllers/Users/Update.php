<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Update\Request as UpdateRequest;
use Illuminate\Http\RedirectResponse;

class Update extends Controller
{
    /**
     *  Update the user's profile information.
     *
     *  @param  \App\Http\Requests\Users\Update\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return $request->is('my/*')
            ? redirect()->route('my.profile.edit')
            : redirect()->route('users.edit', ['user' => $user->id]);
    }
}
