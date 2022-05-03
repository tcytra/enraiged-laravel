<?php

namespace Enraiged\Http\Controllers\Accounts\Profiles;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Resources\AccountProfileResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Show extends Controller
{
    use AuthorizesRequests;

    /** @var  Account  The account model. */
    protected $account;

    /**
     *  Provide the account profile show component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Accounts\Models\Account  $account
     *  @param  \Enraiged\Accounts\Models\Profile  $profile = null
     *  @return \Inertia\Response
     *
     *  @todo   Implement multiple profiles per account
     */
    public function __invoke(Request $request, Account $account, Profile $profile = null)
    {
        $this->account = preg_match('/^my\.account/', $request->route()->getName())
            ? $request->user()->account
            : $account;

        $this->authorize('show', $this->account->profile);

        return inertia('accounts/profiles/Show', [
            'account' => AccountProfileResource::from($this->account),
        ]);
    }
}
