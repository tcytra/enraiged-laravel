<?php

namespace App\Http\Controllers\Users\Profiles;

use App\Http\Controllers\Controller;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests;

    /** @var  User  The user model. */
    protected $user;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user = null
     *  @return \Inertia\Response
     *
     *  @todo   Implement multiple profiles per user
     */
    public function __invoke(Request $request, User $user = null)
    {
        $user = $request->route()->user ?: $request->user();

        $this->authorize('show', $user->profile);

        return inertia('users/profiles/Show', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'user' => UserResource::from($user),
        ]);
    }
}
