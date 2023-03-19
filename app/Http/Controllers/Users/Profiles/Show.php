<?php

namespace App\Http\Controllers\Users\Profiles;

use App\Http\Controllers\Controller;
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
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     *
     *  @todo   Implement multiple profiles per user
     */
    public function __invoke(Request $request, User $user)
    {
        $this->user = preg_match('/^my\./', $request->route()->getName())
            ? $request->user()
            : $user;

        $this->authorize('show', $this->user->profile);

        return inertia('users/profiles/Show', [
            'user' => UserResource::from($this->user),
        ]);
    }
}
