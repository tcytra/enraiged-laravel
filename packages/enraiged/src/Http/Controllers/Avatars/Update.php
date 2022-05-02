<?php

namespace Enraiged\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Http\Requests\Avatars\UpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(UpdateRequest $request, Avatar $avatar)
    {
        $this->authorize('update', $avatar);

        $color = hexdec($request->get('color'));

        (object) $avatar
            ->fill(['color' => $color])
            ->save();

        $request->session()->put('success', 'Color updated');

        return redirect()->back();
    }
}
