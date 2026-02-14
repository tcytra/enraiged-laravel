<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Restore extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  int     $user
     *  @return
     */
    public function __invoke(Request $request, int $user)
    {
        $model = config('auth.providers.users.model');

        $user = $model::withTrashed()
            ->findOrFail($user);

        $this->authorize('restore', $user);

        $message = __('The user has been restored.');
        $redirect = $this->route('users.edit', ['user' => $user]);

        $user->restore();

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'redirect' => $redirect,
                    'success' => $message,
                ]);
        }

        return redirect($redirect)
            ->with('success', $message);

    }
}
