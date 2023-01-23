<?php

namespace App\Http\Controllers\Users\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Resources\AvatarEditResource;
use Enraiged\Users\Resources\UserResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $avatar = $user->profile->avatar;

        $this->authorize('edit', $avatar);

        return inertia('users/avatar/Edit', [
            'avatar' => AvatarEditResource::from($avatar),
            'user' => UserResource::from($user),
        ]);
    }
}
