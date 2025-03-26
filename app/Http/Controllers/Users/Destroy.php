<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Destroy extends Controller
{
    /**
     *  Delete the user's account.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse;
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        if ($user->is_protected) {
            throw ValidationException::withMessages([
                'password' => __('auth.protected'),
            ]);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
