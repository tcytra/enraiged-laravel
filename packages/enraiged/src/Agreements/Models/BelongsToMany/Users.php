<?php

namespace Enraiged\Agreements\Models\BelongsToMany;

use App\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Users
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'agreement_user', 'id', 'agreement_by');
    }
}
