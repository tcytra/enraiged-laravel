<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Support\Facades\Route;

trait FormActions
{
    /** @var  array  The templated form actions. */
    protected $actions;

    /**
     *  Get or set the form actions.
     *
     *  @param  array|null  $actions = null
     *  @param  bool|null   $merge = false
     *  @return array|self
     */
    public function actions(array $actions = null, bool $merge = false)
    {
        if ($actions) {
            $this->actions = $merge
                ? [...$this->actions(), ...$actions]
                : $actions;

            return $this;
        }

        return $this->actions;
    }

    /**
     *  Prepare and return an action from the provided parameters.
     *
     *  @param  string  $action
     *  @param  array   $parameters
     *  @return array
     */
    private function prepareAction($action, $parameters)
    {
        if (key_exists('method', $parameters) && $parameters['method'] === 'emit') {
            $parameters['permission'] = true;
        } else

        if (key_exists('route', $parameters) && Route::has($parameters['route'])) {
            $parameters['permission'] = $this->user->can($action, $this->model);

            if (!key_exists('uri', $parameters) && $parameters['permission']) {
                $route = $parameters['route'];

                $parameters['uri'] = route($route, $this->model->id, config('enraiged.forms.absolute_uris'));

                if (!key_exists('method', $parameters)) {
                    $method = Route::get($route)->methods[0];

                    if ($method !== 'GET') {
                        $parameters['method'] = strtolower($method);
                    }
                }
            }
        }

        return $parameters;
    }

    /**
     *  Prepare the actions provided for this form builder.
     *
     *  @param  array|null  $actions = null
     *  @param  bool|null   $merge = false
     *  @return self
     */
    public function prepareActions(array $actions = null, bool $merge = false)
    {
        if ($actions) {
            $this->actions($actions, $merge);
        }

        $this->actions = collect($this->actions)
            ->transform(fn ($action, $index) => $this->prepareAction($index, $action))
            ->toArray();

        return $this;
    }
}
