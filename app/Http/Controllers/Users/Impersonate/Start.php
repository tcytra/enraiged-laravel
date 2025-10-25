<?php

namespace App\Http\Controllers\Users\Impersonate;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Start extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, User $user)
    {
        $this->authorize('impersonate', $user);

        $request->session()
            ->put('impersonate', $user->id);

        if ($request->expectsJson()) {
        }

        $request->session()
            ->flash('status', 205);

        $request->session()
            ->flash(
                'warning',
                __('Impersonating :name.', ['name' => $user->name])
            );

        return to_route('dashboard');
    }
}
