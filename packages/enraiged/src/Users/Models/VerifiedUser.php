<?php

namespace Enraiged\Users\Models;

use App\Auth\Contracts\MustVerifyEmail as EmailVerificationContract;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedUser extends User implements MustVerifyEmail
{
    use EmailVerificationContract;
}
