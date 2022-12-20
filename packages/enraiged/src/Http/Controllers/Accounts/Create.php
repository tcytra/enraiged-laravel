<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Forms\Builders\CreateForm;
use Enraiged\Accounts\Models\Account;
use Enraiged\Roles\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Create extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the edit account form component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('create', Account::class);

        $form = CreateForm::from($request)
            ->create(Account::class, 'accounts.store')
            ->value('role_id', Role::lowest()->id);

        return inertia('accounts/Create', ['template' => $form->template()]);
    }
}
