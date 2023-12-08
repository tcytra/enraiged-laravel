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
     *  @return \Illuminate\Http\JsonResponse|\Inertia\Response
     */
    public function __invoke(Request $request, $user = null)
    {
        $user = $request->route()->hasParameter('user')
            ? User::findOrFail($user)
            : $request->user();


        $this->authorize('delete', $user);

        if ($user->is_protected) {
            if ($request->is('api/*')) {
                return response()->json(['warn' => __('This user is protected and cannot be deleted')]);
            }

            $request->session()->put('warn', __('This user is protected and cannot be deleted'));

            return $request->redirect();
        }

        $myself = $user->isMyself === true;
        $message = $myself ? 'Account deleted' : 'User deleted';
        $status = $myself ? 205 : 200;

        $user->delete();

        if ($myself) {
            logout($request);
        }

        if ($request->is('api/*')) {
            return response()->json(['success' => __($message)], $status);
        }

        //$request->session()->forget('impersonate');
        $request->session()->put('success', __($message));

        return $request->redirect($myself ? '/' : null);
    }
}
