<?php

namespace App\System\Users\Models;

use App\System\Users\Factories\VerifiedUserFactory;
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
        return new VerifiedUserFactory;
    }
}
