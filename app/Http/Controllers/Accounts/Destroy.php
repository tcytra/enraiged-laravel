<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to destroy the account.
     *
     *  @param  \App\Http\Requests\Accounts\IndexRequest  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account)
    {
        $this->authorize('delete', $account);

        $account->delete();

        if ($request->is('api/*')) {
            return response()->json(['success' => __('Account deleted')]);
        }

        $request->session()->put('success', __('Account deleted'));

        return redirect()->back();
    }
}
