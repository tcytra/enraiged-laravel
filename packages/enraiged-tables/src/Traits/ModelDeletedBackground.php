<?php

namespace Enraiged\Tables\Traits;

trait ModelDeletedBackground
{
    /**
     *  @return string|null
     */
    private function modelDeletedBackground()
    {
        return !is_null($this->deleted_at)
            ? 'danger'
            : null;
    }
}
