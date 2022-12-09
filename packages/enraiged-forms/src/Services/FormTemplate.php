<?php

namespace Enraiged\Forms\Services;

use Illuminate\Support\Facades\Route;

class FormTemplate
{
    /** @var  array  The completed pagination object. */
    protected $builder;

    /**
     *  Create an instance of the TableTemplate service.
     *
     *  @param  object  $builder
     *  @return void
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     *  Format a response from the table builder.
     *
     *  @return array
     */
    public function toArray(): array
    {
        $template = [
            'actions' => $this->builder->actions(),
            'fields' => $this->builder->fields(),
            'resource' => $this->builder->resource(),
            'uri' => $this->builder->uri() ?? $this->uri(),
        ];

        return $template;
    }

    /**
     *  @return string
     */
    private function route($name, $params = []): string
    {
        return route($name, $params, config('enraiged.tables.absolute_uris'));
    }

    /**
     *  Evaluate the resource and prepare the uri, if possible.
     *
     *  @return string|null
     */
    private function uri()
    {
        $resource = (object) $this->builder->resource();
        $uri = null;

        if ($resource && property_exists($resource, 'route')) {
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

    /**
     *  Create a FormTemplate instance and return a processed array.
     *
     *  @param  \Enraiged\Forms\Builders\FormBuilder  $builder  The FormBuilder class.
     *  @return array
     */
    public static function From($builder): array
    {
        $template = new FormTemplate($builder);

        return $template->toArray();
    }
}
