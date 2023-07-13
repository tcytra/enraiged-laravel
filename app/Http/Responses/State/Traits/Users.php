<?php

namespace App\Http\Responses\State\Traits;

use Enraiged\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait Users
{
    /**
     *  Build and return the application auth structure.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function user(Request $request)
    {
        if (Auth::check()) {
            $user = $request->user();
            $user->load('profile');

            return UserResource::from($user);
        }

        return null;
    }
}
