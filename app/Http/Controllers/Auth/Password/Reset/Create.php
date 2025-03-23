<?php

namespace App\Http\Controllers\Auth\Password\Reset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Create extends Controller
{
    /**
     *  Display the password reset view.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');
        $user = $model::where('email', $request->get('email'))->first();

        $props = [
            'email' => $request->get('email'),
            'token' => $request->route('token'),
        ];

        app()->setLocale($user->locale);

        return inertia('auth/ResetPassword', $props);
    }
}
