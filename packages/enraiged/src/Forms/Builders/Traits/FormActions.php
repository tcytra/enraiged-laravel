<?php

namespace Enraiged\Forms\Builders\Traits;

trait FormActions
{
    /** @var  object  The templated form actions. */
    protected $actions;

    /**
     *  Get or set the form actions.
     *
     *  @param  array|null  $actions = null
     *  @return array|self
     */
    public function actions(array $actions = null)
    {
        if ($actions) {
            $this->actions = $actions;

            return $this;
        }

        return $this->actions;
    }
}
