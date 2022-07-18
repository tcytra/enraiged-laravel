<?php

namespace Enraiged\Http\Controllers\Accounts\Impersonate;

use Enraiged\Accounts\Models\Account;
use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Start extends Controller
{
    use AuthorizesRequests;

    /**
     *  Handle a begin impersonation request.
     *
     *  @param Request $request
     */
    public function __invoke(Request $request, Account $account)
    {
        $this->authorize('impersonate', $account);

        $request->session()->put('impersonate', $account->id);
        $request->session()->put('status', 205);
        $request->session()->put('success', 'Begun impersonating.');

        return redirect('/');
    }
}
