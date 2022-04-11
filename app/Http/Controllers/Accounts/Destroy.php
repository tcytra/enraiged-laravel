<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\IndexRequest;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to destroy the account
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Inertia\Response
     */
    public function __invoke(IndexRequest $request, Account $account)
    {
        $this->authorize('destroy', $account);

        $account->delete();

        if (preg_match('/\/api/', $request->uri())) {
            return response()->json(['success' => __('Account deleted')]);
        }

        $request->session()->put('success', __('Account deleted'));

        return redirect()->back();
    }
}
