<?php

namespace Enraiged\Tables\Builders\Traits;

use Illuminate\Support\Facades\Route;

trait TableActions
{
    /** @var  array  The table actions. */
    protected array $actions;

    /**
     *  Return the table actions for the provided resource.
     *
     *  @return array
     */
    public function actions()
    {
        return $this->actions;
    }

    /**
     *  Prepare and return an action from the provided parameters.
     *
     *  @param  object  $model
     *  @param  string  $index
     *  @param  array   $parameters
     *  @return array
     */
    private function actionForRow($model, $index, $parameters)
    {
        if (!key_exists('permission', $parameters)) {
            $parameters['permission'] = false;
        }

        if (key_exists('method', $parameters) && $parameters['method'] === 'emit') {
            $parameters['permission'] = true;

        } else {
            $route = key_exists('route', $parameters)
                ? $parameters['route']
                : preg_replace('/\.+/', '.', "{$this->prefix}.{$index}");

            if (Route::has($route)) {
                $action = key_exists('action', $parameters) ? $parameters['action'] : $index;
                $parameters['permission'] = $this->user->can($action, $model);

                if (!key_exists('uri', $parameters) && $parameters['permission']) {
                    $parameters['uri'] = route($route, $model->{$this->key}, config('enraiged.tables.absolute_uris'));

                    if (!key_exists('method', $parameters)) {
                        $method = Route::get($route)->methods[0];

                        if ($method !== 'GET') {
                            $parameters['method'] = strtolower($method);
                        }
                    }
                }
            }
        }

        return $parameters;
    }

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return array
     */
    public function actionsForRow($model)
    {
        $actions = [];

        foreach ($this->actions as $action => $parameters) {
            if (key_exists('type', $parameters) && $parameters['type'] === 'row') {
                $parameters = $this->actionForRow($model, $action, $parameters);

                if ($this->assertSecure($parameters, $model)) {
                    $actions[$action] = $parameters;
                }
            }
        }

        return $actions;
    }

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return array
     */
    public function assembleTemplateActions($model = null)
    {
        $actions = [];

        foreach ($this->actions as $action => $parameters) {
            if (!key_exists('type', $parameters) || $parameters['type'] === 'table') {
                $route = key_exists('route', $parameters)
                    ? $parameters['route']
                    : preg_replace('/\.+/', '.', "{$this->prefix}.{$action}");

                if (Route::has($route)) {
                    $parameters['permission'] = $this->user->can($action, $model ?? $this->model);

                    if (!key_exists('uri', $parameters)) {
                        $parameters['uri'] = route(
                            $route,
                            [],
                            config('enraiged.tables.absolute_uris')
                        );
                    }
                }

                $actions[$action] = $parameters;
            }
        }

        return $actions;
    }

    /**
     *  Determine if this table has actions for rows.
     *
     *  @return bool
     */
    public function hasRowActions(): bool
    {
        return gettype($this->actions) === 'array'
            && collect($this->actions)
                ->filter(function ($action) {
                    return key_exists('type', $action)
                        && strtolower($action['type']) === 'row';
                })
                ->count() > 0;
    }
}
