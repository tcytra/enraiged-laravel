<?php

namespace Enraiged\Users\Tables\Resources;

use Enraiged\Tables\Traits\ModelDeletedBackground;
use Enraiged\Tables\Traits\ModelInactiveBackground;
use Enraiged\Users\Resources\UserResource;

class IndexResource extends UserResource
{
    use ModelDeletedBackground, ModelInactiveBackground;

    /** @var  bool  Whether or not to include the role with this resource. */
    protected bool $with_role = false;

    /** @var  bool  Whether or not to include the deleted at,by with this resource. */
    protected bool $with_deleted = true;

    /** @var  bool  Whether or not to include the tracking objects with this resource. */
    protected bool $with_tracking = false;

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
                'actions' => $this->resource->actions,
                'created_at' => $this->resource->created->at->short,
            ])
            ->toArray();
    }
}
