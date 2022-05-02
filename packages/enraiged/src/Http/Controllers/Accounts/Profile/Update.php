<?php

namespace Enraiged\Http\Controllers\Accounts\Profile;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Services\UpdateAccount;
use Enraiged\Http\Requests\Accounts\Profile\UpdateRequest;
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
