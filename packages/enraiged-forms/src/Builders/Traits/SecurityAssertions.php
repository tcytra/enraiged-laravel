<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Support\Builders\Security\AssertSecure;
use Enraiged\Support\Builders\Security\RoleAssertions;
use Enraiged\Support\Builders\Security\UserAssertions;

trait SecurityAssertions
{
    use AssertSecure, RoleAssertions, UserAssertions;
}
