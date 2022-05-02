<?php

namespace Enraiged\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Http\Requests\Accounts\IndexRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Index extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account index table.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', Account::class);

        $request = IndexRequest::createFrom($request);

        return inertia('accounts/Index', ['template' => $request->table()->template()]);
    }
}
