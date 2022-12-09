<?php

namespace Enraiged\Profiles\Models\Attributes;

trait Name
{
    /**
     *  @return void
     */
    public function initializeName()
    {
        $this->append('name');
    }

    /**
     *  @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
