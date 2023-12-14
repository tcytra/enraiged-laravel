<?php

namespace App\Http\Controllers\Users\Files;

use App\Http\Controllers\Controller;
use Enraiged\Users\Actions\Builders\UserActions;
use Enraiged\Files\Resources\FileResource;
use Illuminate\Http\Request;

class Index extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $attachable_types = [
            'Enraiged\\Exports\\Models\\Export',
        ];

        $collection = $request->user()
            ->files()
            ->whereIn('attachable_type', $attachable_types)
            ->orderBy('created_at', 'desc')
            ->get();

        $files = FileResource::from($collection)
            ->toArray($request);

        return inertia('users/files/Index', [
            'actions' => UserActions::From($request, $request->user())->actions(),
            'files' => $files,
        ]);
    }
}
