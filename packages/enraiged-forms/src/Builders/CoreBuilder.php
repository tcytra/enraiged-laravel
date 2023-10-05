<?php

namespace Enraiged\Forms\Builders;

use Enraiged\Forms\Contracts\ProvidesRefererRedirect;

class CoreBuilder
{
    use Traits\BuilderConstructor,
        Traits\FormActions,
        Traits\FormFields,
        Traits\FormModel,
        Traits\FormResource,
        Traits\HttpRequest,
        Traits\PopulateFields,
        Traits\SanityChecks,
        Traits\SecurityAssertions;

    /**
     *  Return a form builder instance for 'create' from a model and resource definitions.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  string  $route
     *  @param  string  $method  = 'post'
     *  @return self
     */
    public function create($model, $route, $method = 'post', $params = [])
    {
        $router = $this->router($route);

        $resource = [
            'api' => preg_match('/^api/', $router->uri) === 1 ? true : false,
            'method' => $method,
            'route' => $route,
        ];

        if (count($params)) {
            $resource['params'] = $params;
        }

        return $this->populate(new $model, $resource);
    }

    /**
     *  Return a form builder instance for 'edit' from a model and resource definitions.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  string  $route
     *  @param  string  $method = 'patch'
     *  @param  array   $params = []
     *  @return self
     */
    public function edit($model, $route, $method = 'patch', $params = [])
    {
        $router = $this->router($route);

        $resource = [
            'api' => preg_match('/^api/', $router->uri) === 1 ? true : false,
            'id' => $model->id,
            'method' => $method,
            'route' => $route,
        ];

        if (count($params)) {
            $resource['params'] = $params;
        }

        return $this->populate($model, $resource);
    }

    /**
     *  Return the assembled table template.
     *
     *  @return array
     */
    public function template(): array
    {
        $template = [
            'actions' => $this->actions,
            'class' => $this->class,
            'fields' => $this->fields,
            'labels' => $this->labels,
            'resource' => $this->resource,
        ];

        return $this instanceof ProvidesRefererRedirect
            ? [...$template, 'referer' => $this->referer]
            : $template;
    }

    /**
     *  Create and return a builder from the request and optional parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters = []
     *  @return \Enraiged\Forms\Builders\FormBuilder
     *  @static
     */
    public static function From($request, $parameters = [])
    {
        $called = get_called_class();

        return new $called($request, $parameters);
    }
}
