<?php

namespace Enraiged\Support\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class TableRequest extends Request
{
    /** @var  array|string  The default query sort argument(s). */
    protected $default_sort = ['created_at', 'desc'];

    /** @var  string  The primary key column name. */
    protected $primary_key = 'id';

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Return the table row actions.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $resource
     *  @return array
     */
    public function actions($resource): array
    {
        $actions = [];
        $prefix = trim($this->route_prefix, '.');

        if (isset($this->actions)) {
            foreach ($this->actions as $action => $parameters) {
                //  if a resource action uri is not provided we will attempt to assemble one
                if (!key_exists('uri', $parameters)) {
                    $resource_action = "{$prefix}.{$action}";

                    if (Route::has($resource_action) && $this->user()->can($action, $resource)) {
                        $parameters['uri'] = route($resource_action, $resource->{$this->primary_key});
                    }
                }

                $actions[$action] = $parameters;
            }

            return $actions;
        }

        return [];
    }

    /**
     *  Return the table columns.
     *
     *  @return array
     */
    public function columns(): array
    {
        return collect($this->columns)
            ->transform(function ($row, $index) {
                if (!key_exists('source', $row)) {
                    $row['source'] = "{$this->table_name}.{$index}";
                }
                return $row;
            })
            ->toArray();
    }

    /**
     *  Return the table construct for this request.
     *
     *  @return array
     */
    public function table(): array
    {
        return [
            'actions' => isset($this->actions) ? array_keys($this->actions) : null,
            'columns' => $this->columns(),
            'empty' => 'There are no Accounts to display',
            'key' => $this->primary_key,
            'url' => $this->uri(),
        ];
    }

    /**
     *  Return the uri for the table data request.
     *
     *  @return string
     */
    public function uri(): string
    {
        $uri = $this->uri;

        if (preg_match('/\./', $uri)) {
            $uri = route($uri, [], false);
        }

        return '/'.trim($uri, '/');
    }
}
