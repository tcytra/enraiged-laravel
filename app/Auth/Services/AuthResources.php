<?php

namespace App\Auth\Services;

use Enraiged\Accounts\Resources\AccountResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthResources
{
    /**
     *  Handle a request for the auth resources.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array|null
     */
    public function handle(Request $request)
    {
        if (Auth::check()) {
            $account = $request->user()->account;
            $account->load('profile');

            return [
                'user' => AccountResource::from($account),
            ];
        }

        return null;
    }
}
