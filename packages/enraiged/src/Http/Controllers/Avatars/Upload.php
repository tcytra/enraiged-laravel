<?php

namespace Enraiged\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Http\Requests\Avatars\UploadRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Upload extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UploadRequest $request, Avatar $avatar)
    {
        $this->authorize('upload', $avatar);

        $avatar->upload($request->file('image'));

        $request->session()->put('success', 'Avatar uploaded');

        return redirect()->back();
    }
}
