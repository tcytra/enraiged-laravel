<?php

namespace Enraiged\Avatars\Models\Attributes;

trait AvatarColor
{
    /**
     *  Return the avatar file details.
     *
     *  @return array
     */
    protected function getAvatarColorAttribute()
    {
        return (object) [
            'hex' => $this->indexToHex(),
            'rbg' => $this->indexToRgb(),
        ];
    }

    /**
     *  Return the color hex value.
     *
     *  @return string
     */
    protected function indexToHex()
    {
        [$r, $g, $b] = $this->indexToRgb($this->color);

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    /**
     *  Return the color rgb values.
     *
     *  @return array
     */
    protected function indexToRgb()
    {
        return [
            ($this->color >> 16) & 0xFF,
            ($this->color >> 8) & 0xFF,
            $this->color & 0xFF,
        ];
    }
}
