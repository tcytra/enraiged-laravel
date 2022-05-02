<?php

namespace Enraiged\Accounts\Tables\Resources;

use App\Http\Requests\Accounts\IndexRequest;
use App\Http\Resources\JsonResource;
use Enraiged\Avatars\Resources\AvatarResource;

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
            'birthday' => $this->profile->birthdate ? $this->birthday() : null,
            'created' => date('Y-m-d', strtotime($this->created_at)),
            'deleted' => $this->deleted_at ? date('Y-m-d', strtotime($this->deleted_at)) : null,
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
     *  @return string
     */
    private function birthday()
    {
        return true // show full birthdate, use options for formatting
            ? date('M j Y', strtotime($this->profile->birthdate))
            : date('M j', strtotime($this->profile->birthdate));
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
