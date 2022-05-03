<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\AccountManagementResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests;

    /** @var  Account  The account model. */
    protected $account;

    /**
     *  Provide the account show component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account)
    {
        $this->account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;

        $this->authorize('show', $this->account);

        return inertia('accounts/Show', [
            'account' => AccountManagementResource::from($this->account),
            'actions' => $this->actions(),
        ]);
    }

    /**
     *  Assemble and return the available page actions.
     *
     *  @return array
     */
    private function actions()
    {
        $full_url = false;
        $parameters = ['account' => $this->account->id];

        return [
            'avatar' => $this->account->is_mine
                ? route('my.avatar', [], $full_url)
                : route('accounts.avatar.edit', $parameters, $full_url),

            'login' => $this->account->is_mine
                ? route('my.login', [], $full_url)
                : route('accounts.login.edit', $parameters, $full_url),

            'profile' => $this->account->is_mine
                ? route('my.profile', [], $full_url)
                : route('accounts.profile.edit', $parameters, $full_url),
        ];
    }
}
