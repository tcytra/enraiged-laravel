<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Packages\Users\Tables\UserIndex;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Export extends Controller
{
    use AuthorizesRequests;

    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse;
     */
    public function __invoke(Request $request): JsonResponse|BinaryFileResponse
    {
        $model = config('auth.providers.users.model');

        $this->authorize('export', $model);

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
