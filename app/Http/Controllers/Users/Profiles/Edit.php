<?php

namespace App\Http\Controllers\Users\Profiles;

use App\Enums\Roles;
use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateProfileForm;
use Enraiged\Users\Resources\UserResource;
use Enraiged\Users\Traits\Actions as PageActions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests, PageActions;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $this->authorize('edit', $user); // todo: authorize profile, not user

        $builder = UpdateProfileForm::from($request)
            ->edit($user, 'users.profile.update');

        return inertia('users/profiles/Edit', [
            'actions' => collect($this->actions($user))->except('edit')->values(),
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
