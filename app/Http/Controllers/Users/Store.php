<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\CreateUserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request)
    {
        $this->authorize('create', User::class);

        $user = CreateUserProfile::from($request->validated());

        $request->session()->put('success', 'User created');

        return redirect()->route('users.edit', ['user' => $user->id]);
    }
}
