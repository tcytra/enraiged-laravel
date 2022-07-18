<?php

namespace Enraiged\Forms\Builders;

use Enraiged\Forms\Services\FormTemplate;

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
    public function create($model, $route, $method = 'post')
    {
        $resource = [
            'method' => $method,
            'route' => $route,
        ];

        return $this->populate(new $model, $resource);
    }

    /**
     *  Return a form builder instance for 'edit' from a model and resource definitions.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  string  $route
     *  @param  string  $method  = 'patch'
     *  @return self
     */
    public function edit($model, $route, $method = 'patch')
    {
        $resource = [
            'id' => $model->id,
            'method' => $method,
            'route' => $route,
        ];

        return $this->populate($model, $resource);
    }

    /**
     *  Return a flat array of form field values.
     *
     *  @param  array  $group = null
     *  @return array
     *
    public function flatten($group = null)
    {
        static $fields = [];

        foreach ($this->fields as $each => $object) {
            //  todo (haven't needed it yet...)
        }

        return $fields;
    }*/

    /**
     *  Return the assembled table template.
     *
     *  @return array
     */
    public function template(): array
    {
        return FormTemplate::from($this);
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
