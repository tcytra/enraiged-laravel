<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Support\Security\Traits\AssertSecure;
use Enraiged\Support\Security\Traits\RoleAssertions;

trait SecurityAssertions
{
    use AssertSecure, RoleAssertions;
}
