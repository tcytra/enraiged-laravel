<?php

namespace Enraiged\Http\Controllers\Accounts\Profile;

use App\Http\Controllers\Controller;
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

        $this->authorize('edit', $account);

        $request = EditRequest::createFrom($request);

        $template = $request->form()->edit($account);

        return inertia('accounts/profiles/Edit', ['builder' => $template]);
    }
}
