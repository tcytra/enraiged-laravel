<?php

namespace Enraiged\Images\Traits;

use Enraiged\Images\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Imageable
{
    /**
     *  @return void
     */
    public static function bootImageable()
    {
        self::deleting(function ($imageable) {
            foreach ($imageable->images as $image) {
                $image->delete();
            }
        });
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->latest();
    }
}
