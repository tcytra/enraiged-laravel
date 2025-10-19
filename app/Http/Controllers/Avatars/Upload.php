<?php

namespace App\Http\Controllers\Avatars;

use App\Http\Controllers\Controller;
use App\Http\Requests\Avatars\UploadRequest;
use Enraiged\Avatars\Models\Avatar;
use Enraiged\Avatars\Resources\AvatarResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Upload extends Controller
{
    use AuthorizesRequests;

    /**
     *  Provide the requested avatar.
     *
     *  @param  \Enraiged\Avatars\Models\Avatar  $avatar
     *  @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function __invoke(UploadRequest $request, Avatar $avatar)
    {
        $this->authorize('upload', $avatar);

        $avatar->upload($request->file('image'));

        if ($request->expectsJson()) {
            return response()
                ->json([
                    'avatar' => new AvatarResource($avatar),
                    'success' => __('Avatar file uploaded'),
                ]);
        }

        $request->session()
            ->put('status', 205);
        
        $request->session()
            ->put('success', 'Avatar file uploaded');

        return $request->redirect();
    }
}
