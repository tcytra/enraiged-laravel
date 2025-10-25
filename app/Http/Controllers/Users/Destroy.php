<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Delete the user's account.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse;
     */
    public function __invoke(Request $request): JsonResponse|RedirectResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->routeIs('my.*')
            ? $request->user()
            : $model::findOrFail($request->user);

        $this->authorize('delete', $user);

        $message = $user->isMyself ? 'Your account has been deleted.' : 'The user has been deleted.';
        $status = $user->isMyself ? 205 : 200;

        if ($user->is_protected) {
            throw ValidationException::withMessages([
                'password' => __('auth.protected'),
            ]);
        }

        if ($user->isMyself) {
            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

        } else {
            $user->delete();
        }

        if ($request->expectsJson()) {
            return response()
                ->json(['success' => $message], $status);
        }

        return $user->isMyself
            ? redirect()->to('/')
            : to_route('dashboard', ['success' => $message]);
    }
}
