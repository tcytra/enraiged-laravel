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

    /** @var  User  The request user. */
    protected $user;

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
        $this->user = $request->user();

        $this->authorize('show', $this->account);

        return inertia('accounts/Show', [
            'account' => AccountManagementResource::from($this->account),
            'messages' => $this->messages(),
        ]);
    }

    /**
     *  Construct and return an array of the available page messages.
     *
     *  @return array
     */
    private function messages()
    {
        $messages = [];

        if ($this->account->isMyself()) {
            array_push($messages, message('These are your private account details.'));
        } else

        if ($this->user->account->isAdministrator()) {
            array_push($messages, message('You are viewing this account dashboard as an administrator.', 'warn'));
        }

        return $messages;
    }
}
