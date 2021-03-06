<?php

namespace Enraiged\Http\Controllers\Accounts\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Resources\AvatarEditResource;
use Enraiged\Accounts\Resources\AccountResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the edit account avatar component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $account = $request->user()->account;
        $avatar = $account->profile->avatar;

        $this->authorize('edit', $avatar);

        return inertia('accounts/avatar/Edit', [
            'account' => AccountResource::from($account),
            'avatar' => AvatarEditResource::from($avatar),
        ]);
    }
}
