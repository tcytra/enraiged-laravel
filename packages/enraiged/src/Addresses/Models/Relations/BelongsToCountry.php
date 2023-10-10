<?php

namespace Enraiged\Addresses\Models\Relations;

use Enraiged\Geo\Models\Country;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCountry
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
