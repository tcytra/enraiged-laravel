<?php

namespace App\Auth;

use App\System\Persons\Models\Person;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Traits\Scopes,
        HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'users';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'agreed_at',
        'id',
        'remember_token',
        'verified_at',
    ];

    /** @var  array  The attributes that should be hidden for serialization. */
    protected $hidden = [
        'password',
        'remember_token',
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
    ];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ip_addresses()
    {
        return $this->hasMany(IP::class, 'user_id');
    }

    /**
     *  @return \App\System\Persons\Models\Person
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    /**
     *  Set the password attribute.
     *
     *  @param  string  $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }
}
