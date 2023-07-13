<?php

namespace Enraiged\Images\Models\Attributes;

trait Exif
{
    /**
     *  @return string
     */
    public function getExifAttribute()
    {
        return $this->exif();
    }

    /**
     *  Return the (optionally, specific) exif data for this image file.
     *
     *  @param  array   $values = []
     *  @param  bool    $strict = false
     *  @return array|false
     */
    public function exif($values = [], $strict = false)
    {
        if (!$exif = exif_read_data($this->file->storage)) {
            return false;
        }

        if (count($values)) {
            $exif = collect($exif)
                ->only($values)
                ->toArray();

            if ($strict && count($values) !== count($exif)) {
                return false;
            }
        }

        return $exif;
    }
}
