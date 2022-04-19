<?php

namespace Enraiged\Accounts\Models\HasMany;

use Enraiged\Files\Models\File;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Files
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files(): HasMany
    {
       return $this->hasMany(File::class, 'created_by', 'id');
    }
}
