<?php

namespace Enraiged\Users\Models\Traits;

use Enraiged\Enums\Roles;
use Illuminate\Support\Facades\Auth;

trait HasContext
{
    /**
     *  @return bool
     */
    public function getCanBeSelfDeletedAttribute(): bool
    {
        return $this->isMyself && config('enraiged.auth.allow_self_delete');
    }

    /**
     *  @return bool
     */
    public function getIsAdministratorAttribute(): bool
    {
        return $this->role->is(Roles::Administrator);
    }

    /**
     *  @return bool
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->attributes['is_active'] === 1;
    }

    /**
     *  @return bool
     */
    public function getIsHiddenAttribute(): bool
    {
        return $this->attributes['is_hidden'] === 1;
    }

    /**
     *  @return bool
     */
    public function getIsMyselfAttribute(): bool
    {
        return $this->id === Auth::id();
    }

    /**
     *  @return bool
     */
    public function getIsProtectedAttribute(): bool
    {
        return $this->attributes['is_protected'] === 1;
    }
}
