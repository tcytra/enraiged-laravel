<?php

namespace App\Support;

use Enraiged\Support\Builders\MenuBuilder as EnraigedMenuBuilder;

class MenuBuilder extends EnraigedMenuBuilder
{
    /** @var  string  The menu configuration source type. */
    protected $source = 'file';

    /** @var  string  The menu template file location. */
    protected $template = __DIR__.'/Templates/main-menu.json';
}
