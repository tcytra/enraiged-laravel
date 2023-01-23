<?php

namespace Enraiged\Agreements\Observers;

use Enraiged\Agreements\Enums\AgreementStatus;
use Enraiged\Agreements\Models\Agreement;

class AgreementObserver
{
    /**
     *  Handle the Agreement saved event.
     *
     *  @param  \Enraiged\Agreements\Models\Agreement  $agreement
     *  @return void
     */
    public function saved(Agreement $agreement)
    {
        if ($agreement->wasRecentlyPublished) {
            //  todo: here is an opportunity to develop an automated reaction to publishing;
            //  the system could configured to notify all users that an agreement has been updated
        }
    }

    /**
     *  Handle the Agreement saving event.
     *
     *  @param  \Enraiged\Agreements\Models\Agreement  $agreement
     *  @return void
     */
    public function saving(Agreement $agreement)
    {
        //  as an agreement is being published, archive any previous versions
        if ($agreement->isBeingPublished) {
            $agreement->isBeingPublished = false;

            Agreement::where('type', $agreement->type)
                ->where('status', AgreementStatus::Published)
                ->update(['status', AgreementStatus::Archived]);

            $agreement->wasRecentlyPublished = true;
        }
    }
}
