<?php

namespace Enraiged\Support\Database\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait Created
{
    use AtTimestamp, ByUser;

    /**
     *  @return void
     */
    public static function bootCreated()
    {
        self::creating(fn ($model) => $model->setCreatedBy());
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this
            ->belongsTo(config('auth.providers.users.model'), 'created_by')
            ->withTrashed();
    }

    /**
     *  @return array
     */
    public function getCreatedAttribute()
    {
        return (object) [
            'at' => $this->atTimestamp($this->created_at),
            'by' => $this->byUser($this->createdBy),
        ];
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
