<?php

namespace Enraiged\Avatars\Traits;

use Enraiged\Avatars\Models\Avatar;
use Enraiged\Avatars\Services\GenerateAvatar;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAvatar
{
    /**
     *  @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }

    /**
     *  @return void
     */
    public static function bootHasAvatar()
    {
        self::created(function ($model) {
            $model->generateAvatar();
        });
    }

    /**
     *  @return void
     */
    public function generateAvatar()
    {
        optional($this->avatar)->delete();

        GenerateAvatar::from($this);

        $this->load('avatar');
    }
}
