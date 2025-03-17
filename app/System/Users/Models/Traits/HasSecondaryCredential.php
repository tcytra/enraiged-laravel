<?php

namespace App\System\Users\Models\Traits;

use Illuminate\Support\Facades\Validator;

trait HasSecondaryCredential
{
    /**
     *  Determine if the username is an email address.
     *
     *  @return bool
     */
    public function getUsernameIsEmailAddressAttribute(): bool
    {
        return ! is_null($this->username)
            && ! Validator::make(['username' => $this->username], ['username' => 'email'])->fails();
    }
}
