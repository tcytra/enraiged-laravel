<?php

namespace Enraiged\Agreements\Models\Pivots;

use Enraiged\Agreements\Models\Agreement;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AgreementUser extends Pivot
{
    /** @var  array  The attributes that should be cast. */
    protected $casts = ['agreement_at' => 'datetime'];

    /** @var  bool  Disable timestamps for this table. */
    public $timestamps = false;

    /**
     *  @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($pivot) {
            $pivot->agreement_at = now();
        });
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agreement(): BelongsTo
    {
        return $this->belongsTo(Agreement::class, 'agreement_id');
    }

    
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(auth_model(), 'agreement_by');
    }
}
