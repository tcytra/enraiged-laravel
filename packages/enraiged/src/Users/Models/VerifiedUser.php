<?php

namespace Enraiged\Users\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedUser extends User implements MustVerifyEmail
{
    use Traits\MustVerifyEmail;

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new \Enraiged\Users\Factories\VerifiedUserFactory;
    }
}
