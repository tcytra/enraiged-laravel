<?php

namespace Enraiged\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Relations\HasManyUsers,
        Scopes\StrictVisibility,
        Traits\SecurityRanking;

    /** @var  string  The database table name. */
    protected $table = 'roles';

    /** @var  bool  Indicates if the model should be timestamped. */
    public $timestamps = false;

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id', 'rank'];

    /**
     *  Find a role by its id or name.
     *
     *  @param  mixed   $id
     *  @param  array|string  $columns
     *  @return \Enraiged\Roles\Models\Role
     */
    public static function Find($id, $columns = ['*'])
    {
        if (gettype($id) === 'string') {
            return self::where('name', $id)->first();
        }

        return parent::Find($id, $columns);
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
