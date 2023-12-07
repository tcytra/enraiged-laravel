<?php

namespace Enraiged\Users\Models\Attributes;

use App\Enums\Roles;
use Illuminate\Support\Facades\Auth;

trait HasContext
{
    /**
     *  Initialize the trait.
     *
     *  @return void
     *
    public function initializeContext()
    {
        $this->append(['is_administrator', 'is_myself']);
    }*/

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
    public function getIsMyselfAttribute(): bool
    {
        return $this->id === Auth::id();
    }
}
