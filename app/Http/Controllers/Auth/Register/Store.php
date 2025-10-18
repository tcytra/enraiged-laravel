<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\Request as RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class Store extends Controller
{
    /**
     *  Handle an incoming registration request.
     *
     *  @param  \App\Http\Requests\Auth\Register\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(RegisterRequest $request): RedirectResponse
    {
        $user = $request->registerUser();

        event(new Registered($user));

        Auth::login($user);

        return redirect($this->route('dashboard'));
    }
}
