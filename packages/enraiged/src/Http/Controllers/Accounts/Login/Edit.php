<?php

namespace Enraiged\Http\Controllers\Accounts\Login;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Resources\AccountResource;
use Enraiged\Http\Requests\Accounts\Login\EditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
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
        $account = $request->user()->account;

        $this->authorize('edit', $account);

        $request = EditRequest::createFrom($request); // todo: why can't I inject this request as a dependency?
        $builder = $request->form()->edit($account, 'accounts.login.update');

        return inertia('accounts/login/Edit', [
            'account' => AccountResource::from($account),
            'template' => $builder->template(),
        ]);
    }
}
