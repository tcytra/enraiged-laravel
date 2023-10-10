<?php

namespace App\Http\Controllers\Users\Index;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Tables\Builders\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Export extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->authorize('export', User::class);

        UserIndex::from($request)->export();

        $message = config('queue.default') === 'sync'
            ? 'Export completed.'
            : 'Export started.';

        return response()->json(['success' => $message]);
    }
}
