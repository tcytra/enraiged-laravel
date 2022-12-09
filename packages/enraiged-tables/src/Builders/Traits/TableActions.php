<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Accounts\Models\Account;
use Illuminate\Support\Facades\Route;

trait TableActions
{
    /** @var  array  The table actions. */
    protected $actions;

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @return array
     */
    public function actions()
    {
        return $this->actions;
    }

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $resource
     *  @return array
     */
    public function actionsForRow($resource)
    {
        $actions = [];
        $prefix = trim($this->prefix, '.');
        $routes = Route::getRoutes();

        foreach ($this->actions as $action => $parameters) {
            if (key_exists('type', $parameters) && $parameters['type'] === 'row') {
                if (key_exists('method', $parameters) && $parameters['method'] === 'emit') {
                    $parameters['permission'] = true;

                } else {
                    $resource_route = "{$prefix}.{$action}";

                    if ($routes->hasNamedRoute($resource_route)) {
                        $parameters['permission'] = $this->user->can($action, $resource);

                        if (!key_exists('uri', $parameters) && $parameters['permission']) {
                            $parameters['uri'] = route(
                                $resource_route,
                                $resource->{$this->key},
                                config('enraiged.tables.absolute_uris')
                            );

                            if (!key_exists('method', $parameters)) {
                                $resource_method = $routes
                                    ->getByName($resource_route)
                                    ->methods[0];

                                if ($resource_method !== 'GET') {
                                    $parameters['method'] = strtolower($resource_method);
                                }
                            }
                        }
                    }
                }

                $actions[$action] = $parameters;
            }
        }

        return $actions;
    }

    /**
     *  Return the table row actions for the provided resource.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $resource
     *  @return array
     */
    public function assembleTemplateActions($resource = null)
    {
        $actions = [];
        $prefix = trim($this->prefix, '.');

        foreach ($this->actions as $action => $parameters) {
            if (!key_exists('type', $parameters) || $parameters['type'] === 'table') {
                $resource_action = "{$prefix}.{$action}";

                if (Route::has($resource_action)) {
                    $parameters['permission'] = $this->user->can($action, $resource ?? Account::class);

                    if (!key_exists('uri', $parameters)) {
                        $parameters['uri'] = route(
                            $resource_action,
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
}
