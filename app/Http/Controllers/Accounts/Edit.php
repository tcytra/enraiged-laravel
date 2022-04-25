<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\UpdateRequest;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /** @var  object  The Account to prepare for update. */
    protected $account;

    /**
     *  Display the edit account form component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account = null)
    {
        $this->account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;

        $this->authorize('edit', $this->account);

        $request = UpdateRequest::createFrom($request);

        $template = $request->form()
            ->edit($this->account)
            ->template();

        return inertia('accounts/Edit', ['builder' => $template]);
    }
}
