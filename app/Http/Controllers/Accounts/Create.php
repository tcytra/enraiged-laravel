<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Roles\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\Accounts\CreateRequest;

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

        $request = CreateRequest::createFrom($request);

        $builder = $request
            ->form()
            ->create()
            ->value('role_id', Role::lowest()->id);

        return inertia('accounts/Create', ['builder' => $builder->template()]);
    }
}
