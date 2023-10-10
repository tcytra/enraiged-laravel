<?php

namespace Enraiged\Users\Models\Relations;

use Enraiged\Agreements\Models\Agreement;
use Enraiged\Agreements\Models\Pivots\AgreementUser;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyAgreements
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function agreements(): BelongsToMany
    {
        return $this->belongsToMany(Agreement::class, 'agreement_user', 'agreement_by', 'agreement_id')
            ->using(AgreementUser::class)
            ->withPivot('agreement_at');
    }

    /**
     *  @return void
     */
    public function acceptAgreements()
    {
        $this->agreements()->detach();

        foreach (Agreement::required() as $agreement) {
            $this->agreements()->attach($agreement->id);
        }
    }
}
