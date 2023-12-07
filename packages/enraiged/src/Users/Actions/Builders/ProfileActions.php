<?php

namespace Enraiged\Users\Actions\Builders;

use Enraiged\Support\Builders\ActionBuilder;
use Enraiged\Users\Traits\Assertions\AssertCanBeDeleted;
use Enraiged\Users\Traits\Assertions\AssertIsDeleted;
use Enraiged\Users\Traits\Assertions\AssertIsNotDeleted;

class ProfileActions extends ActionBuilder
{
    use AssertCanBeDeleted, AssertIsDeleted, AssertIsNotDeleted;

    /** @var  string  The menu configuration source type. */
    protected $source = 'file';

    /** @var  string  The actions template file location. */
    protected $template = __DIR__.'/../Templates/profile-actions.json';
}
