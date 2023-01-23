<?php

namespace Enraiged\Avatars\Services;

use Enraiged\Avatars\Models\Avatar;

class DefaultAvatar
{
    /** @var  object  The avatarable model. */
    protected $model;

    /**
     *  @param  object  $model
     *  @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     *  @return Avatar
     */
    public function touch(): Avatar
    {
        $color_index = config('enraiged.avatars.color.default') === 'random'
            ? mt_rand(
                config('enraiged.avatars.color.minimum'),
                config('enraiged.avatars.color.maximum')
            )
            : hexdec(config('enraiged.avatars.color.default'));

        return $this->model
            ->avatar()
            ->firstOrCreate([
                'color' => $color_index,
            ]);
    }

    /**
     *  
     *  @param type $model
     */
    public static function From($model)
    {
        return (new self($model))->touch();
    }
}
