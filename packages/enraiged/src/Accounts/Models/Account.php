<?php

namespace Enraiged\Accounts\Models;

//use App\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model // User
{
    use BelongsTo\User,
        HasOne\Profile,
        SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id', 'email', 'password', 'username', 'is_active', 'is_hidden', 'is_protected',
    ];

    /**
     *  Bootstrap the model and its traits.
     *
     *  @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            event(new \Enraiged\Accounts\Events\AccountCreated($model));
        });

        static::updated(function ($model) {
            event(new \Enraiged\Accounts\Events\AccountUpdated($model));
        });
    }
}
