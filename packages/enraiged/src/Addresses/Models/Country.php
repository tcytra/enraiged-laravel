<?php

namespace App\Project\Addresses\Models;

use App\Project\Profiles\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Country extends Model
{
    /** @var  string  The database table name. */
    protected $table = 'countries';

    /** @var  bool  Indicates if the model should be timestamped. */
    public $timestamps = false;

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function profiles(): HasManyThrough
    {
        return $this->hasManyThrough(Profile::class, Address::class, 'country_id', 'id', 'id', 'addressable_id')
            ->where('addressable_type', Profile::class);
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }
}
