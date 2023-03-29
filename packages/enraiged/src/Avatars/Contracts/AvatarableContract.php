<?php

namespace Enraiged\Avatars\Contracts;

interface AvatarableContract
{
    /**
     *  Return the appropriate characters for the avatar display.
     *
     *  @return string
     */
    public function avatarableCharacters();

    /**
     *  Call the service to generate the avatar for this model.
     *
     *  @return void
     */
    public function generateAvatar();
}
