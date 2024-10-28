<?php

namespace Enraiged\Users\Tables\Resources;

use Enraiged\Users\Resources\UserResource;

class IndexResource extends UserResource
{
    /** @var  bool  Whether or not to include the deleted at,by with this resource. */
    protected bool $with_deleted = false;

    /** @var  bool  Whether or not to include the role with this resource. */
    protected bool $with_role = false;

    /** @var  bool  Whether or not to include a severity level. */
    protected bool $with_severity = false;

    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $this->resource->load('role');

        return collect(parent::toArray($request))
            ->merge([
                'active' => $this->is_active && is_null($this->deleted_at),
                'actions' => $this->resource->actions,
                'created_at' => $this->resource->created->at->short,
                'country' => $this->resource->profile->address
                    ? $this->resource->profile->address->country->code
                    : null,
                'role' => !is_null($this->role_id) ? $this->role->name : null,
            ])
            ->toArray();
    }
}
