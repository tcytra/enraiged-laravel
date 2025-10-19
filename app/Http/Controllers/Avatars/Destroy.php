<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Avatars\Resources\AvatarResource;
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
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, Avatar $avatar)
    {
        $this->authorize('delete', $avatar);

        $avatar->file->delete();

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'avatar' => new AvatarResource($avatar),
                    'success' => __('Avatar file deleted'),
                ]);
        }

        $request->session()->put('success', 'Avatar file deleted');

        return $request->redirect();
    }
}
