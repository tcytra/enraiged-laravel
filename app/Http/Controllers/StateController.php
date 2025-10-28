<?php

namespace App\Http\Controllers;

use App\Http\Requests\State\Request as StateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class StateController extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the current application state.
     *
     *  @param  \App\Http\Requests\State\Request
     *  @param  string|null  $only = null
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(StateRequest $request, $only = null): JsonResponse
    {
        $state = $request->state($only);

        return response()
            ->json($state);
    }
}
