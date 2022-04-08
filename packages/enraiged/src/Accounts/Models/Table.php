<?php

namespace Enraiged\Accounts\Models;

use Enraiged\Accounts\Scopes\AccountVisibility;

class Table extends Account
{
    /**
     *  Perform actions required after the Account boots.
     *
     *  @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new AccountVisibility);
    }
}
