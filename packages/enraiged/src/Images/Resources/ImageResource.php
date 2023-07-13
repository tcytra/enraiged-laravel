<?php

namespace Enraiged\Images\Resources;

use App\Http\Resources\JsonResource;
use Enraiged\Images\Contracts\GeolocatableImage;

class ImageResource extends JsonResource
{
    /**
     *  Transform the resource collection into an array.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @return array
     */
    public function toArray($request): array
    {
        $image = [
            'id' => $this->id,
            'mime' => $this->file->mime,
            'name' => $this->file->name,
            'path' => $this->file->path,
            'size' => $this->file->size,
            'src' => $this->route('images.show', ['image' => $this->id]),
        ];

        if ($this->resource instanceof GeolocatableImage && $this->resource->isJpg()) {
            $image['geo'] = $this->resource->geo_location;
        }

        return $image;
    }
}
