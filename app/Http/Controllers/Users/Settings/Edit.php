<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateSettingsForm;
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

        $builder = UpdateSettingsForm::from($this)
            ->edit($user, 'users.settings.update');

        return inertia('users/settings/Edit', [
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
