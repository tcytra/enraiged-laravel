<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\AccountManagementResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the account show component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account)
    {
        $this->account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;

        $this->authorize('show', $this->account);

        return inertia('accounts/Show', [
            'account' => AccountManagementResource::from($this->account),
        ]);
    }
}
