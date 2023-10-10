<?php

namespace Enraiged\Addresses\Models;

use Enraiged\Support\Database\Traits\CreatedBy;
use Enraiged\Support\Database\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Relations\BelongsToCountry,
        Relations\BelongsToRegion,
        CreatedBy, UpdatedBy;

    /** @var  string  The morphable name. */
    protected $morphable = 'addressable';

    /** @var  string  The database table name. */
    protected $table = 'addresses';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $fillable = [
        'city',
        'country_id',
        'is_default',
        'notes',
        'postal',
        'region_id',
        'street',
        'suite',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'is_default' => 'boolean',
    ];

    /**
     *  Get the parent avatarable model.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}
