<?php

namespace Enraiged\Profiles\Models;

use Enraiged\Avatars\Contracts\AvatarableContract;
use Enraiged\Avatars\Traits\Avatarable;
use Enraiged\Support\Database\Traits\UserTracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model implements AvatarableContract
{
    use Attributes\Initials,
        Attributes\Name,
        HasOne\User,
        Traits\HasFactory,
        Avatarable, SoftDeletes, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'profiles';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['alias', 'birthdate', 'first_name', 'last_name', 'gender', 'salut', 'title'];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [];
}
