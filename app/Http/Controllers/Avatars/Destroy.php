<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Models\Avatar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Destroy extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Avatar $avatar)
    {
        $this->authorize('delete', $avatar);

        $avatar->file->delete();

        $request->session()->put('success', 'Avatar deleted');

        return redirect()->back();
    }
}
