<?php

namespace Enraiged\Avatars\Resources;

use App\Http\Resources\JsonResource;

class AvatarResource extends JsonResource
{
    use Traits\Actions,
        Traits\Avatarable,
        Traits\File,
        Traits\Utility;

    /** @var  bool  Whether or not to include the avatar actions. */
    protected $actions = false;

    /** @var  bool  Whether or not to include the avatar morphable data. */
    protected $morphable = false;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $resource = [
            'id' => $this->id,
            'chars' => $this->avatarable->avatarableCharacters(),
            'color' => $this->indexToHex($this->color),
            'file' => $this->file(),
        ];

        if ($this->actions) {
            $resource['actions'] = $this->actions();
        }

        if ($this->morphable) {
            $resource['avatarable'] = $this->avatarable();
        }

        return $resource;
    }
}
