<?php

namespace Enraiged\Users\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifiedUser extends User implements MustVerifyEmail
{
    use Traits\MustVerifyEmail;
}
