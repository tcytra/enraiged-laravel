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
    private function actionForRow($model, $index, $parameters): array
    {
        $action = key_exists('action', $parameters)
            ? $parameters['action']
            : $index;

        $model = key_exists('model', $parameters)
            ? $parameters['model']
            : $model;

        if (!key_exists('permission', $parameters)) {
            $parameters['permission'] = $this->assertSecure($parameters, $model) && $this->user->can($action, $model);
        }

        $route = key_exists('route', $parameters)
            ? $parameters['route']
            : preg_replace('/\.+/', '.', "{$this->prefix}.{$index}");

        if (Route::has($route) && !key_exists('uri', $parameters) && $parameters['permission']) {
            $parameters['uri'] = route($route, $model->{$this->key}, config('enraiged.tables.absolute_uris'));

            if (!key_exists('method', $parameters)) {
                $method = Route::get($route)->methods[0];

                if ($method !== 'GET') {
                    $parameters['method'] = strtolower($method);
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
    public function actionsForRow($model): array
    {
        $actions = [];

        foreach ($this->actions as $index => $parameters) {
            if (key_exists('type', $parameters) && $parameters['type'] === 'row') {
                $parameters = $this->actionForRow($model, $index, $parameters);

                if ($parameters['permission']) {
                    $actions[$index] = collect($parameters)
                        ->except(['permission', 'route', 'secure', 'secureAll', 'secureAny'])
                        ->toArray();
                }
            }
        }

        return $actions;
    }

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @return array
     */
    protected function assembleTemplateActions()
    {
        $actions = [];

        foreach ($this->actions as $index => $parameters) {
            if (!key_exists('type', $parameters)) {
                $parameters['type'] = 'table';
            }

            if ($parameters['type'] === 'row') {
                $actions[$index] = $parameters;
            }

            if ($parameters['type'] === 'table') {
                $action = key_exists('action', $parameters)
                    ? $parameters['action']
                    : $index;

                $model = key_exists('model', $parameters)
                    ? $parameters['model']
                    : $this->model;

                $parameters['permission'] = $this->user->can($action, $model ?? $this->model);

                if ($parameters['permission']) {
                    $route = key_exists('route', $parameters)
                        ? $parameters['route']
                        : preg_replace('/\.+/', '.', "{$this->prefix}.{$action}");

                    if (Route::has($route) && !key_exists('uri', $parameters)) {
                        $parameters['uri'] = route(
                            $route,
                            [],
                            config('enraiged.tables.absolute_uris')
                        );
                    }

                    if ($this->assertSecure($parameters, $model)) {
                        $actions[$index] = $parameters;
                    }
                }
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

    /**
     *  Remove an action from the table structure.
     *
     *  @param  string  $index
     *  @return self
     */
    public function removeAction($index)
    {
        $this->actions = collect($this->actions)
            ->except($index)
            ->toArray();

        return $this;
    }

    /**
     *  Remove an action from the table structure.
     *
     *  @param  string  $index
     *  @param  boolean|\Closure  $condition
     *  @return self
     */
    public function removeActionIf($index, $condition)
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->removeAction($index);
        }

        return $this;
    }
}
