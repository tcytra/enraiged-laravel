<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use Enraiged\Files\Models\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Process the request to destroy the file
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Files\Models\File  $file
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, File $file)
    {
        $this->authorize('delete', $file);

        $file->attachable->delete();

        $request->session()->put('success', 'File deleted');

        return $request->redirect();
    }
}
