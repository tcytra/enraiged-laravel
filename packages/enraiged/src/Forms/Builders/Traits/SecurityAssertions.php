<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Support\Security\Traits\AssertSecure;
use Enraiged\Support\Security\Traits\RoleAssertions;

trait SecurityAssertions
{
    use AssertSecure,
        RoleAssertions;

    /** @var  bool  Whether or not to apply security assertions to the form builder. */
    protected $assert_security = false;
}
