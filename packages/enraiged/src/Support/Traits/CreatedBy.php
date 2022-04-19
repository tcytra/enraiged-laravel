<?php

namespace Enraiged\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait CreatedBy
{
    /**
     *  @return void
     */
    public static function bootCreatedBy()
    {
        self::creating(fn ($model) => $model->setCreatedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        $model = config('auth.providers.users.model');

        return $this->belongsTo($model, 'created_by');
    }

    /**
     *  @return void
     */
    private function setCreatedBy()
    {
        if (Auth::check()) {
            $this->created_by = Auth::id();
        }
    }
}
