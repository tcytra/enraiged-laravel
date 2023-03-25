<?php

namespace Enraiged\Tables\Traits;

trait ModelInactiveBackground
{
    /**
     *  @return string|null
     */
    private function modelInactiveBackground()
    {
        return !$this->is_active
            ? 'warning'
            : null;
    }
}
