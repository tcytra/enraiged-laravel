<?php

namespace Enraiged\Http\Controllers\Accounts\Settings;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Resources\AccountResource;
use Enraiged\Http\Requests\Accounts\Settings\EditRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Edit extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the edit account form component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $account = $request->user()->account;

        $this->authorize('edit', $account);

        $request = EditRequest::createFrom($request);

        return inertia('accounts/settings/Edit', [
            'account' => AccountResource::from($account),
            'builder' => $request->form()->edit($account),
        ]);
    }
}
