<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Enraiged\Users\Pages\Traits\Actions as PageActions;
use Enraiged\Users\Pages\Traits\Messages as PageMessages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests, PageActions, PageMessages;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  int  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, $user = null)
    {
        $user = preg_match('/^my\.profile/', $request->route()->getName())
            ? $request->user()
            : User::withTrashed()
                ->findOrFail($user);

        $this->authorize('show', $user);

        return inertia('users/Show', [
            'actions' => collect($this->actions($user))
                ->except('show')
                ->toArray(),
            'messages' => $this->messages($user),
            'user' => UserResource::from($user),
        ]);
    }
}
