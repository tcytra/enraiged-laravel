<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AvailabilityRequest;
use Enraiged\Roles\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Available extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \App\Http\Requests\Users\AvailabilityRequest  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AvailabilityRequest $request)
    {
        $this->authorize('available', Role::class);

        $columns = ['roles.id', 'roles.name'];

        $available = Role::select($columns)
            ->where('rank', '>=', $request->user()->role->rank)
            ->orderBy('rank')
            ->limit(100);

        return response()->json($available->get());
    }
}
