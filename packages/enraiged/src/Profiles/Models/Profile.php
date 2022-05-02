<?php

namespace Enraiged\Profiles\Models;

use Enraiged\Profiles\Traits\HasAvatar;
use Enraiged\Support\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use Attributes\Initials,
        Attributes\Name,
        HasOne\Account,
        Traits\HasFactory,
        CreatedBy, HasAvatar, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'profiles';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['alias', 'birthdate', 'first_name', 'last_name', 'salut'];
}
