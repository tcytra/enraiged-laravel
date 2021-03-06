<?php

namespace Enraiged\Http\Controllers\Accounts\Index;

use App\Http\Controllers\Controller;
use Enraiged\Accounts\Models\Account;
use Enraiged\Http\Requests\Accounts\IndexRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Export extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account control panel component.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->authorize('export', Account::class);

        $request = IndexRequest::createFrom($request);

        $request->table()
            ->exporter()
            ->process();

        return response()->json(['success' => 'Export started.']);
    }
}
