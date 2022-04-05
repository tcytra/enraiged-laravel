<?php

namespace App\Account\Models;

use App\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use Attributes\Initials,
        Attributes\Name,
        HasFactory, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'profiles';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id',
    ];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'profile_id', 'id')->withTrashed();
    }
}
