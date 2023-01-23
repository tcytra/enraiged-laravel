<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;

class Store extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(PasswordResetRequest $request)
    {
        $request->handle();

        if ($request->success) {
            $request->session()->put('success', 'Reset successful');

            return redirect()
                ->back()
                ->with(['status' => 200]);
        }

        return inertia('auth/PasswordForgot', [
                'errors' => [
                    'email' => __($request->status),
                ],
            ]);
    }
}
