<?php

namespace Enraiged\Http\Controllers\Accounts\Profiles;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Resources\AccountResource;
use Enraiged\Http\Requests\Accounts\Profile\EditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the edit account avatar component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $account = $request->user()->account;

        $this->authorize('edit', $account); // todo: authorize profile, not account

        $request = EditRequest::createFrom($request);
        $builder = $request->form()->edit($account, 'accounts.profile.update');

        return inertia('accounts/profiles/Edit', [
            'account' => AccountResource::from($account),
            'messages' => [
                message('These are your default profile details. This information is visible only to you and the application administrators.')
            ],
            'template' => $builder->template(),
        ]);
    }
}
