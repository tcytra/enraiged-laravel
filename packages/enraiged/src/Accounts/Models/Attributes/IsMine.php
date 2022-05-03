<?php

namespace Enraiged\Accounts\Models\Attributes;

trait IsMine
{
    /**
     *  @return void
     */
    public function initializeIsMine()
    {
        $this->append('is_mine');
    }

    /**
     *  @return bool
     */
    public function getIsMineAttribute(): bool
    {
        return $this->user->id === user()->id;
    }
}
