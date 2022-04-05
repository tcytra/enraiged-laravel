<?php

namespace App\Account\Models\Attributes;

trait Initials
{
    /**
     *  @return void
     */
    public function initializeInitials()
    {
        $this->append('initials');
    }

    /**
     *  @return string
     */
    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->first_name, 0, 1).substr($this->last_name, 0, 1));
    }
}
