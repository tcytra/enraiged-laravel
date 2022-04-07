<?php

namespace Enraiged\Accounts\Controllers;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\Forms\AccountUpdate as AccountUpdateForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /** @var  object  The Account to prepare for update. */
    protected $account;

    /**
     *  Display the account control panel component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account = null)
    {
        $this->account = $request->route()->getName() === 'my.account'
            ? $request->user()->account
            : $account;

        $this->authorize('edit', $this->account);

        return inertia('accounts/Edit', [
            'accountForm' => AccountUpdateForm::from($this->account),
        ]);
    }

    protected function myAccount($request)
    {
        return $request->route()->getName() === 'my.account';
    }
}
