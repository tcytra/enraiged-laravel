<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Enraiged\Files\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Download extends Controller
{
    use AuthorizesRequests;

    /**
     *  Return the requested file.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Files\Models\File  $file
     *  @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Request $request, File $file)
    {
        $this->authorize('download', $file);

        $headers = ['Content-Type' => $file->mime];
        $location = storage_path("app/{$file->path}");

        return response()->download($location, $file->name, $headers);
    }
}
