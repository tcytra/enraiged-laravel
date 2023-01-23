<?php

namespace Enraiged\Agreements\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Agreements\Enums\AgreementType;
use Illuminate\Support\Str;

class AgreementResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $resource = [
            'created' => $this->datetime('created_at'),
            'content' => Str::markdown($this->content),
            'type' => AgreementType::get($this->type),
            'version' => $this->version,
        ];

        return $resource;
    }
}
