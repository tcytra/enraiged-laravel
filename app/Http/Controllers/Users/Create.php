<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Roles\Models\Role;
use Enraiged\Users\Forms\Builders\CreateForm;
use Enraiged\Users\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Create extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('create', User::class);

        $form = CreateForm::from($request)
            ->create(User::class, 'users.store')
            ->value('role_id', Role::lowest()->id);

        return inertia('users/Create', [
            'page' => [
                'heading' => 'Create User',
                'title' => 'Create User',
            ],
            'template' => $form->template(),
        ]);
    }
}
