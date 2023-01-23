<?php

namespace App\Http\Controllers\Users\Impersonate;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Start extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, User $user)
    {
        $this->authorize('impersonate', $user);

        $request->session()->put('impersonate', $user->id);
        $request->session()->put('status', 205);
        $request->session()->put('success', __('Impersonating :name.', [
            'name' => $user->profile->name,
        ]));

        return redirect(RouteServiceProvider::HOME);
    }
}
