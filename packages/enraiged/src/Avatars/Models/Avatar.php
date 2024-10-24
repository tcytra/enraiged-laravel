<?php

namespace Enraiged\Avatars\Models;

use Enraiged\Files\Traits\Attachable;
use Enraiged\Support\Database\Traits\Created;
use Enraiged\Support\Database\Traits\Updated;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use Attributes\AvatarColor,
        Attributes\AvatarFile,
        Attachable, Created, Updated;

    /** @var  string  The morphable name. */
    protected $morphable = 'avatarable';

    /** @var  string  The avatars storage folder. */
    protected $folder = 'avatars';

    /** @var  string  The database table name. */
    protected $table = 'avatars';

    /** @var  array  The attributes that aren't mass assignable. */
    protected $guarded = ['id'];

    /** @var  array  The image resizable parameters. */
    protected $resize = [
        'width' => 250,
        'height' => 250,
        'strict' => true,
    ];

    /**
     *  Get the parent avatarable model.
     *
     *  @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function avatarable()
    {
        return $this->morphTo();
    }
}
