<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Enraiged\Users\Models\User;
use Enraiged\Users\Tables\UserIndex;
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

        $table = UserIndex::from($request);
        $export = $table->export();

        if ($table->isAutoDownload()) {
            return $export->download();
        }

        if ($table->isQueuedExport()) {
            return response()
                ->json(['success' => 'Export started.']);
        }

        return response()
            ->json(['success' => 'Export added to My Files.']);
    }
}
