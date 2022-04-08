<?php

namespace App\Http\Controllers\Accounts\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\IndexRequest;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Data extends Controller
{
    use AuthorizesRequests;

    /**
     *  Serve the account table data.
     *
     *  @param  \App\Http\Requests\Accounts\IndexRequest  $request
     *  @return 
     */
    public function __invoke(IndexRequest $request)
    {
        $this->authorize('index', Account::class);

        return response()->json(['data' => $request->data()]);
    }
}
