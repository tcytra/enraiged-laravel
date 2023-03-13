<?php

namespace Enraiged\Forms\Builders;

class FormBuilder
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
        $resource = [
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
        $resource = [
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
        return [
            'actions' => $this->actions(),
            'class' => $this->class,
            'fields' => $this->fields(),
            'labels' => $this->labels,
            'resource' => $this->resource(),
            'uri' => $this->uri(),
        ];
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
