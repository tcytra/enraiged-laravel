<?php

namespace App\Menus\Builders;

use Enraiged\Support\Builders\MenuBuilder;

class MainMenu extends MenuBuilder
{
    /** @var  string  The menu configuration source type. */
    protected $source = 'file';

    /** @var  string  The menu template file location. */
    protected $template = __DIR__.'/../Templates/main-menu.json';
}
