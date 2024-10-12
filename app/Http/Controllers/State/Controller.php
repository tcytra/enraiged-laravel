<?php

namespace App\Http\Controllers\State;

use App\Http\Controllers\Controller as AppController;
use Enraiged\Support\Builders\AppStateBuilder;
use Illuminate\Http\Request;

class Controller extends AppController
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $builder = (new AppStateBuilder)
            ->handle($request);

        return response()
            ->json($builder->get());
    }
}
