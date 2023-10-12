<?php

namespace Enraiged\Users\Traits\Attributes;

use Illuminate\Support\Facades\Auth;

trait UserAttribute
{
    /**
     *  Initialize the trait.
     *
     *  @return void
     */
    public function initializeUser()
    {
        $this->append('user');
    }

    /**
     *  Define the attribute accessor.
     *
     *  @return \App\Auth\User
     */
    protected function getUserAttribute()
    {
        return Auth::user();
    }
}
