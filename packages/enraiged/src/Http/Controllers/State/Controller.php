<?php

namespace Enraiged\Http\Controllers\State;

use App\Http\Controllers\Controller as AppController;
use Enraiged\Http\Responses\State\AppState as AppStateResponse;

class Controller extends AppController
{
    /**
     *  
     *  @return \Enraiged\Http\Controllers\AppState
     */
    public function __invoke()
    {
        return new AppStateResponse();
    }
}
