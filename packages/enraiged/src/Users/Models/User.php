<?php

namespace Enraiged\Users\Models;

use Enraiged\Support\Database\Traits\UserTracking;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Attributes\AllowImpersonation,
        Attributes\AllowNameChange,
        Attributes\HasContext,
        Attributes\MustAgreeToTerms,
        BelongsTo\Profile,
        BelongsTo\Role,
        BelongsToMany\Agreements,
        HasMany\Files,
        HasMany\IpAddresses,
        Scopes\Deleted,
        Scopes\NotDeleted,
        Scopes\Reportable,
        Traits\HasFactory,
        Traits\IsProtected,
        Traits\ManagesPassword,
        HasApiTokens, Notifiable, SoftDeletes, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = [
        'dateformat', 'email', 'language', 'name', 'password', 'timeformat', 'timezone', 'username',
        'is_active', 'is_hidden', 'is_protected', 'profile_id', 'role_id',
    ];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [
        'is_active', 'is_hidden', 'is_protected', 'password', 'remember_token',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
        'is_protected' => 'boolean',
    ];

    /**
     *  @todo: This is a temporary attribute, still pondering this one.
     *  User needs ability to select notification channels (global and/or per notification type or hybrid?).
     */
    public $notification_channels = ['mail'];
}
