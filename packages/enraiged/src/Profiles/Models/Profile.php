<?php

namespace Enraiged\Profiles\Models;

use Enraiged\Profiles\Traits\HasAvatar;
use Enraiged\Support\Traits\UserTracking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use Attributes\Initials,
        Attributes\Name,
        HasOne\Account,
        Traits\HasFactory,
        HasAvatar, SoftDeletes, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'profiles';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['alias', 'first_name', 'last_name', 'gender', 'salut', 'title'];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
