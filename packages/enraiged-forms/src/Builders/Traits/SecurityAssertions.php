<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Support\Builders\Security\AssertSecure;
use Enraiged\Support\Builders\Security\RoleAssertions;

trait SecurityAssertions
{
    use AssertSecure,
        RoleAssertions;

    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = false;
}
