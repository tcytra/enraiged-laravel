<?php

namespace Enraiged\Addresses\Traits;

use Enraiged\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Addressable
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }
}
