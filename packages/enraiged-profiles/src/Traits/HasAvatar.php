<?php

namespace Enraiged\Profiles\Traits;

use Enraiged\Avatars\Traits\HasAvatar as CoreHasAvatar;

trait HasAvatar
{
    use CoreHasAvatar;

    /**
     *  @return string
     */
    public function avatarableCharacters()
    {
        return $this->initials;
    }
}
