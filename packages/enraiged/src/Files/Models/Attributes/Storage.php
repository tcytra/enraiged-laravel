<?php

namespace Enraiged\Files\Models\Attributes;

trait Storage
{
    /**
     *  @return string
     */
    public function getStorageAttribute()
    {
        return storage_path("app/{$this->path}");
    }
}
