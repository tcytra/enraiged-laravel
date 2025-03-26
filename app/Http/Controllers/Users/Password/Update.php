<?php

namespace App\Http\Controllers\Users\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Password\Update\Request as UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Update extends Controller
{
    /**
     *  Update the user's password.
     *
     *  @param  \App\Http\Requests\Auth\Password\Update  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        if ($user->is_protected) {
            throw ValidationException::withMessages([
                'password' => __('auth.password.protected'),
            ]);
        }

        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);

        return back();
    }
}
