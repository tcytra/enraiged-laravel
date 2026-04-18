<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Restore extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  int     $user
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $user): JsonResponse|RedirectResponse
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
                    'message' => $message,
                    'redirect' => $redirect,
                    'success' => true,
                ]);
        }

        return redirect($redirect)
            ->with('success', $message);
    }
}
