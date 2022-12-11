<?php

namespace Enraiged\Http\Controllers\Accounts;

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

        if ($account->is_protected) {
            if ($request->is('api/*')) {
                return response()->json(['warn' => __('This account is protected and cannot be deleted')]);
            }

            $request->session()->put('warn', __('This account is protected and cannot be deleted'));

        } else {
            $account->delete();

            if ($request->is('api/*')) {
                return response()->json(['success' => __('Account deleted')]);
            }

            $request->session()->put('success', __('Account deleted'));
        }

        return redirect()->back();
    }
}
