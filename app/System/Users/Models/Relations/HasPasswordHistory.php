<?php

namespace App\System\Users\Models\Relations;

use App\System\Users\Models\PasswordHistory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

trait HasPasswordHistory
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordHistory(): HasMany
    {
        return $this->hasMany(PasswordHistory::class, 'user_id');
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
