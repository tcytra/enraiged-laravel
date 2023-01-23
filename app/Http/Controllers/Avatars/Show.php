<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Models\Avatar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Avatar $avatar)
    {
        return $avatar->file->inline();
    }
}
