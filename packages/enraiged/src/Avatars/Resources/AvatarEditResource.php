<?php

namespace Enraiged\Avatars\Resources;

class AvatarEditResource extends AvatarResource
{
    /** @var  bool  Whether or not to include the avatar actions. */
    protected $actions = true;

    /** @var  bool  Whether or not to include the avatar morphable data. */
    protected $morphable = true;
}
