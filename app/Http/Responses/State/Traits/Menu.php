<?php

namespace App\Http\Responses\State\Traits;

use App\Menus\Builders\MainMenu;
use Illuminate\Http\Request;

trait Menu
{
    /**
     *  Build and return the application menu.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    private function menu(Request $request)
    {
        return MainMenu::From($request)->menu();
    }
}
