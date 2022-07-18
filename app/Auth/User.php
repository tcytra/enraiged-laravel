<?php

namespace App\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Traits\Attributes\AllowImpersonation,
        Traits\Attributes\AllowNameChange,
        Traits\Attributes\MustAgreeToTerms,
        Traits\BelongsTo\Account,
        Traits\BelongsTo\Role,
        Traits\BelongsToMany\Agreements,
        Traits\HasMany\IpAddresses,
        Traits\Scopes,
        Traits\ManagesPassword,
        HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id', 'remember_token', 'verified_at',
    ];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'verified_at' => 'datetime',
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
        'is_protected' => 'boolean',
        'military_time' => 'boolean',
    ];

    /**
     *  @todo: This is a temporary attribute, still pondering this one.
     *  User needs ability to select notification channels (global and/or per notification type or hybrid?).
     */
    public $notification_channels = ['mail'];
}
