<?php

namespace Enraiged\Http\Controllers\Accounts\Files;

use App\Http\Controllers\Controller;
use Enraiged\Files\Resources\FileResource;
use Illuminate\Http\Request;

class Index extends Controller
{
    /**
     *  Display the account index table.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $attachable_types = [
            'Enraiged\\Exports\\Models\\Export',
        ];

        $collection = $request->user()->account
            ->files()
            ->whereIn('attachable_type', $attachable_types)
            ->orderBy('created_at', 'desc')
            ->get();

        $files = FileResource::from($collection)
            ->toArray($request);

        return inertia('accounts/files/Index', ['files' => $files]);
    }
}
