<?php

namespace Enraiged\Accounts\Models\Traits;

use Enraiged\Roles\Enums\Roles;
use Illuminate\Support\Facades\Auth;

trait HasContext
{
    /**
     *  Initialize the trait.
     *
     *  @return void
     */
    public function initializeContext()
    {
        $this->append(['is_administrator', 'is_myself']);
    }

    /**
     *  @return bool
     */
    public function getIsAdministratorAttribute(): bool
    {
        return $this->user->role->is(Roles::Administrator);
    }

    /**
     *  @return bool
     */
    public function getIsMyselfAttribute(): bool
    {
        return $this->user->id === Auth::id();
    }
}
