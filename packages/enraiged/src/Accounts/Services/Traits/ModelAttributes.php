<?php

namespace Enraiged\Accounts\Services\Traits;

use Enraiged\Accounts\Collections\Attributes as AccountAttributes;
use Enraiged\Profiles\Collections\Attributes as ProfileAttributes;

trait ModelAttributes
{
    /**
     *  @return array
     */
    protected function getAccountAttributes()
    {
        return AccountAttributes::$fillable;
    }

    /**
     *  @return array
     */
    protected function getProfileAttributes()
    {
        return ProfileAttributes::$fillable;
    }
}
