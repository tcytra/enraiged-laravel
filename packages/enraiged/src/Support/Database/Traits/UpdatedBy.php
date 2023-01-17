<?php

namespace Enraiged\Support\Database\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait UpdatedBy
{
    /**
     *  @return void
     */
    public static function bootUpdatedBy()
    {
        self::updating(fn ($model) => $model->setUpdatedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'updated_by');
    }

    /**
     *  @return void
     */
    private function setUpdatedBy()
    {
        $this->updated_by = Auth::check() ? Auth::id() : 1;
    }
}
