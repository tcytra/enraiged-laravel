<?php

namespace Enraiged\Users\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternetAddress extends Model
{
    use Relations\BelongsToUser,
        SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'ip_addresses';

    /** @var  array  The attributes that are mass assignable. */
    protected $fillable = ['ip_address', 'user_id'];

    /**
     *  Convert the user ip_address from binary to a human readable format.
     *
     *  @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function ipAddress(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ip_from_binary($value),
            set: fn ($value) => ip_to_binary($value),
        );
    }

    /**
     *  Return the ip_address.
     *
     *  @return string
     */
    public function ip()
    {
        return $this->ip_address;
    }
}
