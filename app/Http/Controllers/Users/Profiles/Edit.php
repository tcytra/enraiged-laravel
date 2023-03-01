<?php

namespace App\Http\Controllers\Users\Profiles;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateProfileForm;
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

        $this->authorize('edit', $user); // todo: authorize profile, not user

        $builder = UpdateProfileForm::from($this)
            ->edit($user, 'users.profile.update');

        return inertia('users/profiles/Edit', [
            'messages' => [
                message('These are your default profile details. This information is visible only to you and the application administrators.')
            ],
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
