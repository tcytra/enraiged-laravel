<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Requests\Auth\RegisterRequest;

class Store extends \App\Http\Controllers\Auth\Controller
{
    /**
     *  Handle an incoming authentication request.
     *
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = $request->handle();

        return redirect()->route('auth.login');
    }
}
