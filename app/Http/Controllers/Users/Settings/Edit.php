<?php

namespace App\Http\Controllers\Users\Settings;

use App\Http\Controllers\Controller;
use Enraiged\Users\Actions\Builders\ProfileActions;
use Enraiged\Users\Forms\Builders\UpdateSettingsForm;
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

        $this->authorize('settingsEdit', $user);

        $builder = UpdateSettingsForm::from($request)
            ->edit($user, 'users.settings.update')
            ->value('theme', $user->theme ?? config('enraiged.theme.color'));

        return inertia('users/settings/Edit', [
            'actions' => ProfileActions::From($request, $user)->values(),
            'template' => $builder->template(),
            'user' => UserResource::from($user),
        ]);
    }
}
