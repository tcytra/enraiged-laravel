<?php

namespace Enraiged\Support\Resources;

class ReadableDatetimeAttributeResource extends DatetimeAttributeResource
{
    /** @var  bool  Whether or not to include the human readable (contextual) formats. */
    protected $readable = true;
}
