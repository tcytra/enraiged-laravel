<?php

namespace Enraiged\Users\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use Relations\BelongsToUser;

    /** @var  string|null  The name of the "updated at" column.*/
    const UPDATED_AT = null;

    /** @var  string  The database table name. */
    protected $table = 'password_history';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['password'];
}
