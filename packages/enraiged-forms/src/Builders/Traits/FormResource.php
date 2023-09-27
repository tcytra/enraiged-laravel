<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Support\Facades\Route;

trait FormResource
{
    /** @var  object  The templated form resource parameters. */
    protected $resource;

    /** @var  string  The uri for the table data request. */
    protected $uri;

    /**
     *  Get or set the form resource.
     *
     *  @param  array|null  $resource = null
     *  @return array|self
     */
    public function resource(array $resource = null)
    {
        if ($resource) {
            if ($uri = $this->uri($resource)) {
                $resource['uri'] = $uri;
            }

            $this->resource = $resource;

            return $this;
        }

        return $this->resource;
    }

    /**
     *  @return string
     */
    protected function route($name, $params = []): string
    {
        return route($name, $params, config('enraiged.tables.absolute_uris'));
    }

    /**
     *  Get or set the form uri.
     *
     *  @param  array  $resource
     *  @return string
     */
    protected function uri($resource): string
    {
        $resource = (object) $resource;
        $uri = null;

        if (property_exists($resource, 'route')) {
            $route = Route::getRoutes()->getByName($resource->route);

            if (property_exists($resource, 'params')) {
                $uri = $this->route($resource->route, $resource->params);

            } else if (property_exists($resource, 'id')) {
                preg_match('/\{[a-z]+\}/', $route->uri, $parameter_keys);

                $key = trim(array_shift($parameter_keys), '{}');
                $uri = $this->route($resource->route, [$key => $resource->id]);

            } else {
                $uri = route($resource->route, [], config('enraiged.forms.absolute_uris'));
            }
        }

        return $uri;
    }
}
