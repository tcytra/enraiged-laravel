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

        foreach ($this->actions as $action => $parameters) {
            if (key_exists('type', $parameters) && $parameters['type'] === 'row') {
                $resource_action = "{$prefix}.{$action}";

                if (Route::has($resource_action)) {
                    $parameters['permission'] = $this->user->can($action, $resource);

                    if (!key_exists('uri', $parameters) && $parameters['permission']) {
                        $parameters['uri'] = route(
                            $resource_action,
                            $resource->{$this->key},
                            config('enraiged.tables.full_urls')
                        );
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
    public function actionsForTable($resource = null)
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
                            config('enraiged.tables.full_urls')
                        );
                    }
                }

                $actions[$action] = $parameters;
            }
        }

        return $actions;
    }
}
