<?php

namespace App\Http\Controllers\Accounts\Login;

use App\Http\Requests\Accounts\Login\EditRequest;
use App\Http\Controllers\Controller;
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

        $request = EditRequest::createFrom($request); // todo: why can't I inject this request as a dependency?

        $template = $request->form()->edit($account);

        return inertia('accounts/login/Edit', ['builder' => $template]);
    }
}
