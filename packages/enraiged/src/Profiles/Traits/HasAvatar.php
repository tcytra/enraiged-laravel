<?php

namespace Enraiged\Profiles\Traits;

use Enraiged\Avatars\Traits\HasAvatar as Avatarable;

trait HasAvatar
{
    use Avatarable;

    /**
     *  @return string
     */
    public function avatarableCharacters()
    {
        return $this->initials;
    }
}
