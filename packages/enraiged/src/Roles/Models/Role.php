<?php

namespace Enraiged\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasMany\Users,
        Scopes\StrictVisibility,
        Traits\SecurityRanking;

    /** @var  string  The database table name. */
    protected $table = 'roles';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [];

    /** @var  bool  Indicates if the model should be timestamped. */
    public $timestamps = false;

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
