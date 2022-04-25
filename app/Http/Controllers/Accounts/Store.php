<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\CreateRequest;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Services\CreateAccount;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to store the account.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(CreateRequest $request)
    {
        $this->authorize('create', Account::class);

        $account = CreateAccount::from($request->validated());

        $request->session()->put('success', 'Account created');

        return redirect()->route('accounts.edit', ['account' => $account->id]);
    }
}
