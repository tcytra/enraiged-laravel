<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Packages\Users\Tables\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Data extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('index', $model);

        $table = UserIndex::from($request);

        return response()->json($table->data());
    }
}
