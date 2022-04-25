<?php

namespace Enraiged\Forms\Builders;

use Enraiged\Forms\Services\FormTemplate;

class FormBuilder
{
    use Traits\BuilderConstructor,
        Traits\FormActions,
        Traits\FormFields,
        Traits\FormResource,
        Traits\HttpRequest,
        Traits\PopulateFields,
        Traits\SanityChecks,
        Traits\SecurityAssertions;

    /**
     *  Return a flat array of form field values.
     *
     *  @param  array  $group = null
     *  @return array
     */
    public function flatten($group = null)
    {
        static $fields = [];

        foreach ($this->fields as $each => $object) {
            
        }

        return $fields;
    }

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
