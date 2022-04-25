<?php

namespace App\Auth\Traits\BelongsTo;

use Enraiged\Roles\Models\Role as RoleModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Role
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'id');
    }
}
