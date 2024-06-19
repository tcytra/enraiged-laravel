<?php

namespace App\Http\Responses\State\Traits;

use App\Support\MenuBuilder;
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
        return MenuBuilder::From($request)->menu();
    }
}
