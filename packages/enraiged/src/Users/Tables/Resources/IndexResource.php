<?php

namespace Enraiged\Users\Tables\Resources;

use Enraiged\Avatars\Resources\AvatarResource;
use Enraiged\Support\Resources\DatetimeAttributeResource as Datetime;
use Enraiged\Tables\Traits\ModelDeletedBackground;
use Enraiged\Tables\Traits\ModelInactiveBackground;
use Enraiged\Users\Resources\UserResource;

class IndexResource extends UserResource
{
    use ModelDeletedBackground, ModelInactiveBackground;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return collect(parent::toArray($request))
            ->merge([
                '__' => $this->modelDeletedBackground() ?? $this->modelInactiveBackground(),
                'active' => $this->is_active && is_null($this->deleted_at),
                'alias' => $this->profile->alias,
                'birthday' => $this->profile->birthdate,
                'first_name' => $this->profile->first_name,
                'last_name' => $this->profile->last_name,
                'role' => $this->role(),
                'salut' => $this->profile->salut,
                'created' => Datetime::from($this)->createdAtDate(),
                'deleted' => Datetime::from($this)->deletedAtDate(),
                'actions' => $this->resource->actions,
            ])
            ->toArray();
    }

    /**
     *  @return array
     */
    private function avatar()
    {
        $this->profile->load('avatar');

        return AvatarResource::from($this->profile->avatar);
    }

    /**
     *  @return string|null
     */
    private function role()
    {
        return $this->role
            ? $this->role->name
            : null;
    }
}
