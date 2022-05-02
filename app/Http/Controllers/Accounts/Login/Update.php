<?php

namespace App\Http\Controllers\Accounts\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\Login\UpdateRequest;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Services\UpdateAccount;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(UpdateRequest $request, Account $account)
    {
        $this->authorize('update', $account);

        UpdateAccount::from($account, $request->validated());

        $request->session()->put('success', 'Update successful');

        return redirect()->back();
    }
}
