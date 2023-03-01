<?php

namespace Enraiged\Avatars\Models\Attributes;

trait AvatarFile
{
    /**
     *  Return the avatar file details.
     *
     *  @return array
     */
    protected function getAvatarFileAttribute()
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
