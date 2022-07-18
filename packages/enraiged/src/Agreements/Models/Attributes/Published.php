<?php

namespace Enraiged\Agreements\Models\Attributes;

use Enraiged\Agreements\Enums\AgreementStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait Published
{
    /** @var  bool  Whether this agreement is being published. */
    public $isBeingPublished = false;

    /** @var  bool  Whether this agreement was just published. */
    public $wasRecentlyPublished = false;

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publishedBy(): BelongsTo
    {
        return $this->belongsTo(auth_model(), 'created_by');
    }

    /**
     *  Publish this agreement.
     *
     *  @return self
     */
    public function publish()
    {
        $this->isBeingPublished = true;

        $parameters = [
            'published_at' => now(),
            'published_by' => Auth::check() ? Auth::id() : null,
            'status' => AgreementStatus::Published,
        ];

        $this->update($parameters);

        return $this;
    }
}
