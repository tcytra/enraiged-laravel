<?php

namespace Enraiged\Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait DeletedBy
{
    /**
     *  @return void
     */
    public static function bootDeletedBy()
    {
        self::deleting(fn ($model) => $model->setDeletedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        $model = config('auth.providers.users.model');

        return $this->belongsTo($model, 'deleted_by');
    }

    /**
     *  @return void
     */
    private function setDeletedBy()
    {
        if (Auth::check()) {
            $this->deleted_by = Auth::id();
        }
    }
}
