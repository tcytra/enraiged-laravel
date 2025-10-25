<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Date;
use Illuminate\Auth\Middleware\RequirePassword as Middleware;

class RequirePassword extends Middleware
{
    /**
     * Determine if the confirmation timeout has expired.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|null  $passwordTimeoutSeconds
     * @return bool
     */
    protected function shouldConfirmPassword($request, $passwordTimeoutSeconds = null)
    {
        $confirmedAt = Date::now()->unix() - $request->session()->get('auth.password_confirmed_at', 0);

        return !$request->session()->has('impersonate')
            && $confirmedAt > ($passwordTimeoutSeconds ?? $this->passwordTimeout);
    }
}
