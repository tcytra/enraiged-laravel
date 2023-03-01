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
     *  @return array
     */
    public function getUpdatedAttribute()
    {
        return [
            'at' => $this->atTimestamp($this->updated_at),
            'by' => $this->byUser($this->updatedBy),
        ];
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
