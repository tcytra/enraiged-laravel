<?php

namespace Enraiged\Avatars\Resources\Traits;

trait Avatarable
{
    /**
     *  Return a definition of the morphed class.
     *
     *  @return array
     */
    protected function avatarable()
    {
        return [
            'id' => $this->avatarable->id,
            'type' => get_class_name($this->avatarable),
        ];
    }
}
