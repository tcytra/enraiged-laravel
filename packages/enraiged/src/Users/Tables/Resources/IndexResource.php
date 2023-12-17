<?php

namespace Enraiged\Users\Tables\Resources;

use Enraiged\Users\Resources\UserResource;

class IndexResource extends UserResource
{
    /** @var  bool  Whether or not to include the role with this resource. */
    protected $with_role = false;

    /** @var  bool  Whether or not to include the deleted at,by with this resource. */
    protected $deleted = true;

    /** @var  bool  Whether or not to include a severity level. */
    protected $severity = true;

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
                'role' => !is_null($this->role_id) ? $this->role->name : null,
            ])
            ->toArray();
    }
}
