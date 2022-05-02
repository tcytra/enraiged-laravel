<?php

namespace Enraiged\Files\Resources;

use Enraiged\Http\Resources\DatetimeAttributeResource;
use Enraiged\Http\Resources\JsonResource;

class FileResource extends JsonResource
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
            'created' => $this->created(),
            'icon' => $this->icon(),
            'name' => $this->name,
            'size' => $this->size,
            'type' => $this->type,
        ];
    }

    /**
     *  @return array
     */
    private function created()
    {
        return DatetimeAttributeResource::from($this->resource)
            ->attribute('created_at');
    }

    /**
     *  @return string
     */
    private function icon(): string
    {
        return in_array($this->resource->type, ['XLS', 'XLSX'])
            ? 'pi pi-file-excel'
            : 'pi pi-file';
    }
}
