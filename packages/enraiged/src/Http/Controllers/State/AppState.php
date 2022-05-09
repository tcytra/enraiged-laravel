<?php

namespace Enraiged\Http\Controllers\State;

use App\Http\Controllers\Controller;
use Enraiged\Http\Responses\State\AppState as AppStateResponse;

class AppState extends Controller
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
