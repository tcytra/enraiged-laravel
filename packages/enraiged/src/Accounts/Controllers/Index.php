<?php

namespace Enraiged\Accounts\Controllers;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\Tables\AccountsIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Index extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account control panel component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', Account::class);

        return inertia('accounts/Index', [
            'accountsIndex' => AccountsIndex::from(Account::all()),
        ]);
    }
}
