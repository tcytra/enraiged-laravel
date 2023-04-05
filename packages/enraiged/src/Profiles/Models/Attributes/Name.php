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
        return $this->name();
    }

    /**
     *  @param  bool    $reversed = false
     *  @param  bool    $comma_separated = false
     *  @return string
     */
    public function name($reversed = false, $comma_separated = false)
    {
        if ($reversed) {
            $comma = $comma_separated ? ',' : '';

            return "{$this->last_name}{$comma} {$this->first_name}";
        }

        return "{$this->first_name} {$this->last_name}";
    }
}
