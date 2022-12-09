<?php

namespace Enraiged\Files\Traits;

use Enraiged\Files\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasFile
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'attachable')->withDefault();
    }

    /**
     *  @return void
     */
    protected static function bootHasFile()
    {
        self::deleting(function ($model) {
            if ($model->file->exists) {
                $model->file->delete();
            }
        });
    }
}
