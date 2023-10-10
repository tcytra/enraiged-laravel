<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Enraiged\Users\Traits\Actions as PageActions;
use Enraiged\Users\Traits\Messages as PageMessages;
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
        $this->user = preg_match('/^my\./', $request->route()->getName())
            ? $request->user()
            : User::withTrashed()
                ->findOrFail($user);

        $this->authorize('show', $this->user);

        return inertia('users/Show', [
            'actions' => $this->user->is_myself
                ? collect($this->actions($this->user))->except('show')->values()
                : [],
            'messages' => $this->messages($this->user),
            'user' => UserResource::from($this->user),
        ]);
    }
}
