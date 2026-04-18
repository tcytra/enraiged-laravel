<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Packages\Users\Tables\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Index extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('index', $model);

        $table = UserIndex::from($request)
            ->template();

        return inertia('users/Index', ['table' => $table]);
    }
}
