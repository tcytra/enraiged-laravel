<?php

namespace App\Http\Controllers\Auth\Password\Confirm;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Store extends Controller
{
    /**
     *  Confirm the user's password.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     *
     *  @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $parameters = [
            'email' => $request->user()->email,
            'password' => $request->password,
        ];

        if (! Auth::guard('web')->validate($parameters)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()
            ->put('auth.password_confirmed_at', time());

        return redirect()
            ->intended($this->route('dashboard'));
    }
}
