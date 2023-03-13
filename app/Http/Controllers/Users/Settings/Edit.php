<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use Enraiged\Users\Forms\Builders\UpdateSettingsForm;
use Enraiged\Users\Resources\UserResource;
use Enraiged\Users\Pages\Traits\Actions as PageActions;
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

        $this->authorize('edit', $user);

        $builder = UpdateSettingsForm::from($request)
            ->edit($user, 'users.settings.update');

        return inertia('users/settings/Edit', [
            'actions' => collect($this->actions($user))
                ->except('settings')
                ->toArray(),
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
