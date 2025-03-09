<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Edit extends Controller
{
    /**
     *  Display the user's profile forms.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        return inertia('Profile/Edit', [
            'canDeleteAccount' => config('enraiged.auth.allow_self_delete') === true,
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
}
