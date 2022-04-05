<?php

namespace App\Http\Controllers\Account;

use App\Account\Models\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountUpdate;
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
