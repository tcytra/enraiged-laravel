<?php

namespace App\Http\Controllers\Accounts\Files;

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
        $files = $request->user()->account->files;

        return inertia('accounts/files/Index', ['files' => FileResource::from($files)->toArray($request)]);
    }
}
