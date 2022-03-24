<?php

namespace App\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternetAddress extends Model
{
    use SoftDeletes;

    /** @var  string  The database table name. */
    protected $table = 'ip_addresses';
}
