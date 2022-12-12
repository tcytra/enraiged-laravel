<?php

namespace Enraiged\Http\Controllers\Accounts\Index;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Accounts\Tables\Builders\AccountsIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Data extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the account table data.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', Account::class);

        $table = AccountsIndex::From($request);

        return response()->json($table->data());
    }
}
