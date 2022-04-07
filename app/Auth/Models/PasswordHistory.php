<?php
namespace App\Auth\Models;

use App\Auth\User;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    /** @var  string  The database table name. */
    protected $table = 'password_history';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['password'];

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
