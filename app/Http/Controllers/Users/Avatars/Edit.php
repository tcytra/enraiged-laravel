<?php

namespace App\Http\Controllers\Users\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Resources\AvatarEditResource;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Models\User;
use Enraiged\Users\Resources\UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Users\Models\User  $user
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, User $user = null)
    {
        $user = $request->route()->user ?: $request->user();
        $avatar = $user->profile->avatar;

        $this->authorize('avatarEdit', $user);

        return inertia('users/avatar/Edit', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'avatar' => AvatarEditResource::from($avatar),
            'user' => UserResource::from($user),
        ]);
    }
}
