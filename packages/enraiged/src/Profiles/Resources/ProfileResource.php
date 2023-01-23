<?php

namespace Enraiged\Profiles\Resources;

use App\Http\Resources\JsonResource;

class ProfileResource extends JsonResource
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
            'alias' => $this->alias,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'salut' => $this->salut,
            'title' => $this->title,
        ];
    }
}
