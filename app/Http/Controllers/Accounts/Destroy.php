<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\TableRequest;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to destroy the account
     *
     *  @param  \App\Http\Requests\Accounts\TableRequest  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Inertia\Response
     */
    public function __invoke(TableRequest $request, Account $account)
    {
        $this->authorize('delete', $account);

        $account->delete();

        if (preg_match('/\/api/', $request->table()->uri())) {
            return response()->json(['success' => __('Account deleted')]);
        }

        $request->session()->put('success', __('Account deleted'));

        return redirect()->back();
    }
}
