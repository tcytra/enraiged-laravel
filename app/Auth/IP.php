<?php

namespace App\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IP extends Model
{
    use SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'user_ip_addresses';
}
