<?php

namespace App\Http\Controllers\Account;

use App\Account\Models\Account;
use App\Account\Resources\AccountFormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account control panel component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account = null)
    {
        $this->authorize('edit', $account ?? $request->user());

        return inertia('account/Edit', [
            'accountForm' => AccountFormBuilder::from($request->user()),
        ]);
    }
}
