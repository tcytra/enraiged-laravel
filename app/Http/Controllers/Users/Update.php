<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\UpdateUserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\UpdateRequest  $request
     *  @param  int  $user
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, $user)
    {
        $user = User::withTrashed()->findOrFail($user);

        $this->authorize('update', $user);

        UpdateUserProfile::from($user, $request->validated());

        if ($request->is('api/*')) {
            return response()->json([
                'redirect' => $request->redirect(),
                'success' => __('User updated'),
            ]);
        }

        $request->session()->put('success', __('User updated'));

        return $request->redirect();
    }
}
