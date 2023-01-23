<?php

namespace Enraiged\Users\Models\Traits;

use Enraiged\Users\Models\PasswordHistory;
use Illuminate\Support\Facades\Hash;

trait ManagesPassword
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordHistory()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     *  Compare the current password with a provided value.
     *
     *  @param  string  $password
     *  @return bool
     */
    public function currentPasswordIs(string $password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     *  Set the password attribute.
     *
     *  @param  string  $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password)
            ? Hash::make($password)
            : $password;
    }
}
