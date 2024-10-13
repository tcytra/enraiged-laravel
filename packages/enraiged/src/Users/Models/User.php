<?php

namespace Enraiged\Users\Models;

use Enraiged\Support\Contracts\ProvidesDropdownOption;
use Enraiged\Support\Database\Traits\UserTracking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements ProvidesDropdownOption
{
    use Attributes\AllowImpersonation,
        Attributes\AllowNameChange,
        Attributes\MustAgreeToTerms,
        Relations\BelongsToProfile,
        Relations\BelongsToRole,
        Relations\BelongsToManyAgreements,
        Relations\HasManyFiles,
        Relations\HasManyInternetAddresses,
        Relations\HasManyPasswordHistory,
        Scopes\Active,
        Scopes\Deleted,
        Scopes\Reportable,
        Traits\DropdownOption,
        Traits\GetFillable,
        Traits\HasContext,
        HasApiTokens, HasFactory, Notifiable, SoftDeletes, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id',
        'remember_token',
    ];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var  array  The attributes that should be cast. */
    protected $casts = [
        'is_active' => 'boolean',
        'is_hidden' => 'boolean',
        'is_protected' => 'boolean',
    ];

    /**
     *  @todo: This is a temporary attribute, still pondering this one.
     *  User needs ability to select notification channels (global and/or per notification type or hybrid?).
     */
    public $notification_channels = ['mail'];

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new \Enraiged\Users\Factories\UserFactory;
    }
}
