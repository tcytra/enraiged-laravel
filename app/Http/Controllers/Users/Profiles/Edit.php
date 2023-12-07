<?php

namespace App\Http\Controllers\Users\Profiles;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Forms\Builders\UpdateProfileForm;
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

        $this->authorize('edit', $user);

        $builder = UpdateProfileForm::from($request)
            ->edit($user, 'users.profile.update');

        return inertia('users/profiles/Edit', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'messages' => $this->messages($request),
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function messages($request)
    {
        $messages = [];

        $messages[] = $request->user()->role->is(Roles::Administrator)
            ? message('These are your default profile details.')
            : message('These are your default profile details. This information is visible only to you and the application administrators.');

        return $messages;
    }
}
