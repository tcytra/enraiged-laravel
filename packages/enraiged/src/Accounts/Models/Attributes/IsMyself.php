<?php

namespace Enraiged\Accounts\Models\Attributes;

trait IsMyself
{
    /**
     *  @return void
     */
    public function initializeIsMyself()
    {
        $this->append('is_myself');
    }

    /**
     *  @return bool
     */
    public function getIsMyselfAttribute(): bool
    {
        return $this->user->id === user()->id;
    }
}
