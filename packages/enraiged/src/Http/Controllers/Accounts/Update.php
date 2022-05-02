<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Services\UpdateAccount;
use Enraiged\Http\Requests\Accounts\UpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to update the account.
     *
     *  @param  \App\Http\Requests\Accounts\UpdateRequest  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, Account $account)
    {
        $this->authorize('update', $account);

        UpdateAccount::from($account, $request->validated());

        $request->session()->put('success', 'Update successful');

        return redirect()->back();
    }
}
