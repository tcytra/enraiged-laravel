<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Forms\Builders\UpdateForm;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\AccountResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /** @var  Account  The account model. */
    protected $account;

    /** @var  User  The request user. */
    protected $user;

    /**
     *  Display the edit account form component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request, Account $account = null)
    {
        $this->account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;
        $this->user = $request->user();

        $this->authorize('edit', $this->account);

        $form = UpdateForm::from($request)
            ->edit($this->account, 'accounts.update');

        return inertia('accounts/Edit', [
            'account' => AccountResource::from($this->account),
            'messages' => $this->messages(),
            'template' => $form->template(),
        ]);
    }

    /**
     *  Construct and return an array of the available page messages.
     *
     *  @return array
     */
    private function messages()
    {
        if (!$this->account->is_myself && $this->user->account->is_administrator) {
            return [message('You are updating these account details as an administrator.', 'warn')];
        }

        return [];
    }
}
