<?php

namespace Enraiged\Support\Traits;

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
        return $this->belongsTo(auth_model(), 'updated_by');
    }

    /**
     *  @return void
     */
    private function setUpdatedBy()
    {
        if (Auth::check()) {
            $this->updated_by = Auth::id();
        }
    }
}
