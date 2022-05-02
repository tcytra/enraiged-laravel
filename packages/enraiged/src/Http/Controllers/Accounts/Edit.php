<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Http\Requests\Accounts\UpdateRequest;
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
    public function __invoke(Request $request, Account $account = null)
    {
        $account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;

        $this->authorize('edit', $account);

        $request = UpdateRequest::createFrom($request);

        $template = $request->form()->edit($account);

        return inertia('accounts/Edit', ['builder' => $template]);
    }
}
