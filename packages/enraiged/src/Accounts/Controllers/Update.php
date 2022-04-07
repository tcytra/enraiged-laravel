<?php

namespace Enraiged\Accounts\Controllers;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Requests\AccountUpdate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account control panel component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(AccountUpdate $request, Account $account)
    {
        $this->authorize('update', $account);

        $request->handle();

        $request->session()->put('success', 'Update successful');

        return redirect()->back();
    }
}
