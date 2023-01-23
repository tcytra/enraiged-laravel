<?php

namespace Enraiged\Avatars\Resources\Traits;

trait Utility
{
    /**
     *  Return the color hex value.
     *
     *  @return string
     */
    protected function indexToHex($color)
    {
        [$r, $g, $b] = $this->indexToRgb($color);

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    /**
     *  Return the color rgb values.
     *
     *  @return array
     */
    protected function indexToRgb($color)
    {
        return [
            ($color >> 16) & 0xFF,
            ($color >> 8) & 0xFF,
            $color & 0xFF,
        ];
    }
}
