<?php

namespace Enraiged\Images\Models;

use App\Enums\FileTypes;
use Enraiged\Files\Traits\Attachable;
use Enraiged\Support\Database\Traits\Created;
use Enraiged\Support\Database\Traits\Updated;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Attributes\Exif,
        Attributes\Folder,
        Attributes\GeoLocation,
        Attachable, Created, Updated;

    /** @var  string  The morphable name. */
    protected $morphable = 'imageable';

    /** @var  string  The database table name. */
    protected $table = 'images';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id'];

    /**
     *  Get the parent imageable model.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     *  Determine whether this is a gif image.
     *  @return bool
     */
    public function isGif()
    {
        return $this->file->mime === FileTypes::GIF;
    }

    /**
     *  Determine whether this is a jpg image.
     *  @return bool
     */
    public function isJpg()
    {
        return $this->file->mime === FileTypes::JPG;
    }

    /**
     *  Determine whether this is a png image.
     *  @return bool
     */
    public function isPng()
    {
        return $this->file->mime === FileTypes::PNG;
    }
}
