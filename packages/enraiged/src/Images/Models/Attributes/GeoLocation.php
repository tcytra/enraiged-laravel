<?php

namespace Enraiged\Images\Models\Attributes;

trait GeoLocation
{
    /**
     *  @return array|null
     */
    public function getGeoLocationAttribute(): ?array
    {
        if (!$exif = $this->exif(['GPSLatitude', 'GPSLatitudeRef', 'GPSLongitude', 'GPSLongitudeRef'], true)) {
            return null;
        }

        return [
            'latitude' => $this->parseGeoCoordinates($exif['GPSLatitude'], $exif['GPSLatitudeRef']),
            'longitude' => $this->parseGeoCoordinates($exif['GPSLongitude'], $exif['GPSLongitudeRef']),
        ];
    }

    /**
     *  @param  array   $gps
     *  @param  string  $ref
     *  @return float
     */
    private function parseGeoCoordinates($gps, $ref)
    {
        $ref = in_array($ref, ['S', 'W']) ? -1 : 1;

        $gps = collect($gps)
            ->transform(function ($value) {
                [$numerator, $denominator] = explode('/', $value);
                return $numerator / $denominator;
            })
            ->toArray();

        [$degrees, $minutes, $seconds] = $gps;

        return intval( (($degrees +(($minutes /60) +($seconds /3600))) *$ref) *1000000000) /1000000000;
    }
}
