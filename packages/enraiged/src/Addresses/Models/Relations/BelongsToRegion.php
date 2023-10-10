<?php

namespace Enraiged\Addresses\Models\Relations;

use Enraiged\Geo\Models\Region;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRegion
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
