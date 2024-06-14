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
     *  @param  string|null  $attribute = null
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, $user, $attribute = null)
    {
        $user = User::withTrashed()->findOrFail($user);

        $this->authorize('update', $user);

        $validated = $request->validated($attribute);

        UpdateUserProfile::from($user, $validated);

        if ($request->is('api/*')) {
            return response()->json([
                //'redirect' => $request->redirect('users.index'),
                'redirect' => $this->route('users.index'),
                'success' => __($request->successMessage()),
            ]);
        }

        $request->session()->put('success', __($request->successMessage()));

        return $request->redirect('users.index');
    }
}
