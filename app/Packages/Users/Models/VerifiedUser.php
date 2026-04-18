<?php

namespace App\Packages\Users\Models;

use App\Packages\Users\Factories\VerifiedUserFactory;
use App\Packages\Users\Models\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedUser extends Authenticatable implements MustVerifyEmail
{
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
