<?php

namespace Enraiged\Accounts\Tables\Resources;

use Enraiged\Avatars\Resources\AvatarResource;
use Enraiged\Http\Requests\Accounts\IndexRequest;
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
        if ($request instanceof IndexRequest) {}
        else {
            $request = IndexRequest::createFrom($request);
        }

        $this->request = $request;

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
            'birthday' => $this->date('birthdate'),
            'created' => $this->date('created_at'),
            'deleted' => $this->date('deleted_at'),
            'actions' => $request->table()->actionsForRow($this->resource),
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
    private function date($attribute)
    {
        if ($this->{$attribute}) {
            $resource = (object) Datetime::fromAttribute($this, $attribute, $this->request);

            return $resource->date;
        }

        return null;
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
