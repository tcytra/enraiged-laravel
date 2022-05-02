<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Services\CreateAccount;
use Enraiged\Http\Requests\Accounts\CreateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to store the account.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request)
    {
        $this->authorize('create', Account::class);

        $account = CreateAccount::from($request->validated());

        $request->session()->put('success', 'Account created');

        return redirect()->route('accounts.edit', ['account' => $account->id]);
    }
}
