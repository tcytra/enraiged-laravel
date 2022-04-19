<?php

namespace App\Http\Controllers\Accounts\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\IndexRequest;
use Enraiged\Accounts\Models\Account;
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

        $request = IndexRequest::createFrom($request);

        return response()->json($request->table()->data());
    }
}
