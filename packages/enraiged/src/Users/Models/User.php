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
        Relations\BelongsToProfile,
        Relations\BelongsToRole,
        Relations\BelongsToManyAgreements,
        Relations\HasManyFiles,
        Relations\HasManyInternetAddresses,
        Scopes\Active,
        Scopes\Deleted,
        Scopes\Reportable,
        Traits\HasFactory,
        Traits\IsProtected,
        Traits\ManagesPassword,
        HasApiTokens, Notifiable, SoftDeletes, UserTracking;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id', 'remember_token',
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
     *  Get the fillable attributes for the model.
     *
     *  @return array
     */
    public function getFillable()
    {
        return [
            'created_by',
            'deleted_by',
            'email',
            'is_active',
            'is_hidden',
            'is_protected',
            'language',
            'password',
            'profile_id',
            'role_id',
            'theme',
            'timezone',
            'updated_by',
        ];
    }
}
