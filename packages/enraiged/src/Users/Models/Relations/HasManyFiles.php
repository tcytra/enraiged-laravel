<?php

namespace Enraiged\Users\Models\Relations;

use Enraiged\Files\Models\File;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyFiles
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(): HasMany
    {
       return $this->hasMany(File::class, 'created_by', 'id');
    }
}
