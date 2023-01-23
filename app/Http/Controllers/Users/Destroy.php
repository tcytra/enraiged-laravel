<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\IndexRequest  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        if ($user->is_protected) {
            if ($request->is('api/*')) {
                return response()->json(['warn' => __('This user is protected and cannot be deleted')]);
            }

            $request->session()->put('warn', __('This user is protected and cannot be deleted'));

        } else {
            $user->delete();

            if ($request->is('api/*')) {
                return response()->json(['success' => __('User deleted')]);
            }

            $request->session()->put('success', __('User deleted'));
        }

        return redirect()->back();
    }
}
