<?php

namespace Enraiged\Avatars\Resources\Traits;

trait File
{
    /**
     *  Return the avatar file details.
     *
     *  @return array
     */
    protected function file()
    {
        if ($this->file->exists) {
            return [
                'mime' => $this->file->mime,
                'name' => $this->file->name,
                'size' => $this->file->size,
                'type' => $this->file->type,
                'uri' => route('avatars.show', ['avatar' => $this->id]),
            ];
        }

        return null;
    }
}
