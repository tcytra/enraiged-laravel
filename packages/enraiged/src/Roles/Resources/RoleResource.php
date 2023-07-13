<?php

namespace Enraiged\Roles\Resources;

use App\Http\Resources\JsonResource;

class RoleResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rank' => $this->rank,
        ];
    }
}
