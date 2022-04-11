<?php

namespace App\Http\Controllers\Accounts\Index;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\IndexRequest;
use Enraiged\Accounts\Models\Account;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Export extends Controller
{
    use AuthorizesRequests;

    /**
     *  Display the account control panel component.
     *
     *  @param  \App\Http\Requests\Accounts\IndexRequest  $request
     *  @return \Inertia\Response
     */
    public function __invoke(IndexRequest $request)
    {
        $this->authorize('index', Account::class);

        
    }
}
