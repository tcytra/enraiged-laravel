<?php

namespace Enraiged\Roles\Models;

use Enraiged\Roles\Scopes\RoleVisibility;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasMany\Users,
        Traits\SecurityRanking;

    /** @var  string  The database table name. */
    protected $table = 'roles';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [];

    /** @var  bool  Indicates if the model should be timestamped. */
    public $timestamps = false;

    /**
     *  Perform actions required after the Account boots.
     *
     *  @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new RoleVisibility);
    }

    /**
     *  Return the lowest ranking application role.
     *
     *  @return self
     *  @static
     */
    public static function Lowest(): self
    {
        return self::orderBy('rank', 'desc')->first();
    }
}
