<?php

namespace Enraiged\Support\Builders\Security;

use Illuminate\Support\Facades\Auth;

trait AuthAssertions
{
    /**
     *  Assert a user is authenticated.
     *
     *  @return bool
     */
    protected function assertIsAuth(): bool
    {
        return Auth::check();
    }

    /**
     *  Assert a user is not authenticated.
     *
     *  @return bool
     */
    protected function assertIsGuest(): bool
    {
        return !Auth::check();
    }
}
