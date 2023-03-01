<?php

namespace App\Http\Controllers\Users\Login;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateLoginForm;
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

        $builder = UpdateLoginForm::from($request)
            ->fieldIf('email', ['after' => 'md:col-6'], !config('enraiged.auth.allow_username_login'))
            ->edit($user, 'users.login.update');

        return inertia('users/login/Edit', [
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
