<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Register\Request as RegisterRequest;
use App\Models\User;
use App\Models\VerifiedUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $parameters = [
            'locale' => $request->get('locale'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
        ];

        $user = config('enraiged.auth.must_verify_email') === true
            ? VerifiedUser::create($parameters)
            : User::create($parameters);

        event(new Registered($user));

        Auth::login($user);

        return redirect($this->route('dashboard'));
    }
}
