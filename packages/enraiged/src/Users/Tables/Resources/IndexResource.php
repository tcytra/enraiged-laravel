<?php

namespace Enraiged\Users\Tables\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Avatars\Resources\AvatarResource;
use Enraiged\Support\Resources\DatetimeAttributeResource as Datetime;
use Enraiged\Tables\Traits\ModelDeletedBackground;
use Enraiged\Tables\Traits\ModelInactiveBackground;

class IndexResource extends JsonResource
{
    use ModelDeletedBackground, ModelInactiveBackground;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \App\Http\Requests\Users\TableRequest  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            '__' => $this->modelDeletedBackground() ?? $this->modelInactiveBackground(),
            'id' => $this->id,
            'avatar' => $this->avatar(),
            'alias' => $this->profile->alias,
            'active' => $this->is_active && is_null($this->deleted_at),
            'email' => $this->email,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'name' => $this->profile->name,
            'role' => $this->role(),
            'salut' => $this->profile->salut,
            'username' => $this->username,
            'birthday' => $this->profile->birthdate,
            'is_active' => $this->is_active,
            'created' => Datetime::from($this)->createdAtDate(),
            'deleted' => Datetime::from($this)->deletedAtDate(),
            'actions' => $this->resource->actions,
        ];
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
