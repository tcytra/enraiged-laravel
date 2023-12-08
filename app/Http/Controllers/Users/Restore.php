<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Restore extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\IndexRequest  $request
     *  @param  int     $user_id
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, $user_id)
    {
        $user = User::withTrashed()->find($user_id);

        $this->authorize('restore', $user);

        $user->restore();

        if ($request->is('api/*')) {
            return response()->json(['success' => __('User restored')]);
        }

        $request->session()->put('success', __('User restored'));

        return $request->redirect();
    }
}
