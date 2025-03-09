<?php

namespace App\Http\Controllers\Auth\Password\Reset;

use App\Http\Controllers\Controller;
use App\System\Users\Models\User;
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
        $user = User::where('email', $request->get('email'))->first();

        $props = [
            'email' => $request->get('email'),
            'token' => $request->route('token'),
        ];

        app()->setLocale($user->locale);

        return inertia('Auth/ResetPassword', $props);
    }
}
