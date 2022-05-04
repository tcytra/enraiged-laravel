<?php

namespace Enraiged\Accounts\Models\Attributes;

use Enraiged\Roles\Enums\Roles;

trait IsAdministrator
{
    /**
     *  @return void
     */
    public function initializeIsAdministrator()
    {
        $this->append('is_administrator');
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
    public function isAdministrator(): bool
    {
        return $this->is_administrator === true;
    }
}
