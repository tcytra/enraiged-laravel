<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedUser extends User implements MustVerifyEmail
{
    use Contracts\MustVerifyEmail;
}
