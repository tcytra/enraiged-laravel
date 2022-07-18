<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

trait FormModel
{
    /** @var  Model  The form resource model. */
    protected $model;

    /**
     *  Get or set the form builder model.
     *
     *  @param  Model   $model = null
     *  @return Model|self
     */
    protected function model($model = null)
    {
        if ($model) {
            if (!$model instanceof Model) {
                throw new UnprocessableEntityHttpException(
                    __('A model was not provided to populate the form with')
                );
            }

            $this->model = $model;

            return $this;
        }

        return $this->model;
    }
}
