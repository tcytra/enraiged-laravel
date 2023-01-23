<?php

namespace Enraiged\Avatars\Models\Attributes;

trait Folder
{
    /**
     *  @return void
     */
    public function initializeFolder()
    {
        $this->append('folder');
    }

    /**
     *  @return string
     */
    public function getFolderAttribute()
    {
        return config('enraiged.avatars.storage');
    }
}
