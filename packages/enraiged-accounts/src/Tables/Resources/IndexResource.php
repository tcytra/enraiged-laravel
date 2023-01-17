<?php

namespace Enraiged\Accounts\Tables\Resources;

use Enraiged\Avatars\Resources\AvatarResource;
use Enraiged\Http\Resources\Attributes\DatetimeAttributeResource as Datetime;
use Enraiged\Http\Resources\JsonResource;

class IndexResource extends JsonResource
{
    /** @var  TableRequest  The http request. */
    protected $request;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \App\Http\Requests\Accounts\TableRequest  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar(),
            'alias' => $this->profile->alias,
            'active' => $this->is_active ? true : false,
            'email' => $this->email,
            'first_name' => $this->profile->first_name,
            'last_name' => $this->profile->last_name,
            'name' => $this->profile->name,
            'role' => $this->role(),
            'username' => $this->username,
            'birthday' => $this->birthdate,
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
        return $this->user->role
            ? $this->user->role->name
            : null;
    }
}
