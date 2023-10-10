<?php

namespace App\Http\Controllers\Users\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Login\UpdateRequest;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\UpdateUserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\Settings\UpdateRequest  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        UpdateUserProfile::from($user, $request->validated());

        $request->session()->put('status', 205);
        $request->session()->put('success', 'Update successful');

        return redirect('/my/profile');
    }
}
