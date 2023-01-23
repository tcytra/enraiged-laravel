<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller as AppController;
use App\Http\Responses\State\AppState as AppStateResponse;

class Controller extends AppController
{
    /**
     *  
     *  @return \App\Http\Responses\State\AppState
     */
    public function __invoke()
    {
        return new AppStateResponse();
    }
}
