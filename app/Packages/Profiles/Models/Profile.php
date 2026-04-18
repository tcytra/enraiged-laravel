<?php

namespace App\Packages\Profiles\Models;

use App\Packages\Profiles\Factories\ProfileFactory;
use App\Packages\Users\Models\User;
use Enraiged\Profiles\Models\Profile as Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    #[\Override]
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'profile_id', 'id')
            ->withTrashed();
    }

    /**
     *  Create a new factory instance for the model.
     *
     *  @return \Illuminate\Database\Eloquent\Factories\Factory
     *  @static
     */
    protected static function newFactory()
    {
        return new ProfileFactory;
    }
}
