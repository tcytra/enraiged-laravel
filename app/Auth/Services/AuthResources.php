<?php

namespace App\Auth\Services;

use App\Http\Resources\Auth\UserResource;
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
            $request->user()->load('profile');

            return [
                'user' => UserResource::from($request->user()),
            ];
        }

        return null;
    }
}
