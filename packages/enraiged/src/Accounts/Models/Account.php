<?php

namespace Enraiged\Accounts\Models;

use App\Auth\Traits\IsProtected;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use BelongsTo\User,
        HasOne\Profile,
        IsProtected, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id', 'email', 'password', 'username', 'is_active', 'is_hidden', 'is_protected',
    ];
}
