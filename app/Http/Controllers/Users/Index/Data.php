<?php

namespace App\Http\Controllers\Users\Index;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Tables\Builders\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Data extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->authorize('index', User::class);

        $table = UserIndex::from($request);

        return response()->json($table->data());
    }
}
