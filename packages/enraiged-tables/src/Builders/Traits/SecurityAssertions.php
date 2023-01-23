<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Support\Builders\Security\AssertSecure;
use Enraiged\Support\Builders\Security\RoleAssertions;

trait SecurityAssertions
{
    use AssertSecure, RoleAssertions;
}
