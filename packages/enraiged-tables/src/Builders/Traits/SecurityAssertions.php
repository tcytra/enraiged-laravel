<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Support\Builders\Security\AssertSecure;
use Enraiged\Support\Builders\Security\AuthAssertions;
use Enraiged\Support\Builders\Security\RoleAssertions;
use Enraiged\Support\Builders\Security\UserAssertions;

trait SecurityAssertions
{
    use AssertSecure, AuthAssertions, RoleAssertions, UserAssertions;
}
