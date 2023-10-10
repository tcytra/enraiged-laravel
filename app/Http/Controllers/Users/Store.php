<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use Enraiged\Users\Models\User;
use Enraiged\Users\Services\CreateUserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\CreateRequest  $request
     *  @return @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request)
    {
        $this->authorize('create', User::class);

        CreateUserProfile::from($request->validated());

        if ($request->is('api/*')) {
            return response()->json([
                'redirect' => $request->redirect(),
                'success' => __('User created'),
            ]);
        }

        $request->session()->put('success', 'User created');

        return $request->redirect();
    }
}
