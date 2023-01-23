<?php

namespace App\Http\Controllers\Users\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Login\EditRequest;
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

        $request = EditRequest::createFrom($request); // todo: why can't I inject this request as a dependency?
        $builder = $request->form()->edit($user, 'users.login.update');

        return inertia('users/login/Edit', [
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
