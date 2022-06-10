<?php

namespace Enraiged\Accounts\Models;

use App\Auth\Traits\IsProtected;
use App\Auth\Traits\ManagesPassword;
use Enraiged\Support\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use Attributes\IsAdministrator,
        Attributes\IsMyself,
        BelongsTo\Profile,
        HasMany\Files,
        HasOne\User,
        Traits\HasFactory,
        CreatedBy, IsProtected, ManagesPassword, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = [
        'agreement_version', 'birthdate', 'dateformat', 'email', 'language', 'password', 'timezone', 'username',
        'is_active', 'is_hidden', 'is_protected', 'military_time', 'profile_id', 'role_id',
    ];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [
        'is_active', 'is_hidden', 'is_protected', 'password', 'remember_token',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'agreed_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
        'is_protected' => 'boolean',
        'military_time' => 'boolean',
    ];
}
