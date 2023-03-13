<?php

namespace Enraiged\Avatars\Services;

use Enraiged\Avatars\Models\Avatar;

class GenerateAvatar
{
    /** @var  object  The avatarable model. */
    protected $model;

    /**
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     *  @return \Enraiged\Avatars\Models\Avatar
     */
    public function generate(): Avatar
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
     *  Generate an avatar from a provided model.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return \Enraiged\Avatars\Models\Avatar
     */
    public static function From($model): Avatar
    {
        return (new self($model))->generate();
    }
}
