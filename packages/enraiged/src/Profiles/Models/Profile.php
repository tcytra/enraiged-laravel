<?php

namespace Enraiged\Profiles\Models;

use Enraiged\Support\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use Attributes\Initials,
        Attributes\Name,
        HasOne\Account,
        Traits\HasFactory,
        CreatedBy, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'profiles';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id'];
}
