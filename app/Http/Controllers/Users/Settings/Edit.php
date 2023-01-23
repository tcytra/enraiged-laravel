<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Settings\EditRequest;
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

        $this->authorize('edit', $user);

        $request = EditRequest::createFrom($request);
        $builder = $request->form()->edit($user, 'users.settings.update');

        return inertia('users/settings/Edit', [
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
