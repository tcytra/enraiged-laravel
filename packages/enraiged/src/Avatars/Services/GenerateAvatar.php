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
        return $this->model
            ->avatar()
            ->firstOrCreate([
                'color' => mt_rand(0, 0xABCDEF),
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
