<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Enraiged\Users\Traits\Messages as PageMessages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests, PageMessages;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, $user = null)
    {
        $user = $request->route()->hasParameter('user')
            ? User::withTrashed()->findOrFail($user)
            : $request->user();

        $this->authorize('show', $user);

        return inertia('users/Show', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'messages' => $this->messages($user),
            'user' => UserResource::from($user),
        ]);
    }
}
