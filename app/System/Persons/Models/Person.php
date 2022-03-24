<?php

namespace App\System\Persons\Models;

use App\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'persons';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = [
        'id',
    ];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'person_id', 'id')->withTrashed();
    }
}
