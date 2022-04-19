<?php

namespace Enraiged\Accounts\Models;

use Enraiged\Accounts\Scopes\ReportableAccounts;

class Index extends Account
{
    /**
     *  Perform actions required after the Account boots.
     *
     *  @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ReportableAccounts);
    }
}
