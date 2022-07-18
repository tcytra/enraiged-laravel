<?php

namespace Enraiged\Forms\Builders\Traits;

trait FormFields
{
    /**
     *  Get or set a form field.
     *
     *  @param  string  $name
     *  @param  array   $params = null
     *  @param  array   $depth = []
     *  @return array|self
     *
     *  @todo   This handles sections now also.. rename from field() to object() (?)
     */
    public function field($name, $params = null, $rewrite = false, $depth = [])
    {
        $fields = &$this->fields;

        if (count($depth)) {
            foreach ($depth as $level) {
                $fields = &$fields[$level];
            }
        }

        if (key_exists($name, $fields)) {
            $object = &$fields[$name];

            if ($this->assert_security && !$this->assertSecure($object)) {
                unset($fields[$name]);
            }

            if ($params) {
                $fields[$name] = $rewrite
                    ? $params
                    : collect($fields[$name])
                        ->merge($params)
                        ->toArray();

                return $this;
            }

            return $object;
        }

        $keys = array_keys($fields);

        foreach ($keys as $each) {
            $object = $fields[$each];

            if ($this->hasSectionFields($object)) {
                if ($this->assert_security && !$this->assertSecure($object)) {
                    unset($fields[$each]);
                }

                $layers = collect($depth)
                    ->merge($each)
                    ->merge('fields')
                    ->toArray();
                $search = $this->field($name, $params, $rewrite, $layers);

                if ($search) {
                    return $search;
                }
            }
        }

        return null;
    }

    /**
     *  Get or set the form fields.
     *
     *  @param  array|null  $fields = null
     *  @return array|self
     */
    public function fields(array $fields = null)
    {
        if ($fields) {
            $this->fields = $fields;

            return $this;
        }

        return $this->fields;
    }

    /**
     *  Get the type of the specified field.
     *
     *  @param  string  $name
     *  @return string|null
     */
    protected function fieldType($name, $params = null)
    {
        $field = (object) ($params ?? $this->field($name));

        if ($field) {
            return property_exists($field, 'type')
                ? $field->type
                : 'input';
        }

        return null;
    }

    /**
     *  Retrieve and return a set of select options.
     *
     *  @param  array|object  $options
     *  @return array
     */
    protected function selectOptions($options)
    {
        $source = $options->source;
        $values = [];

        if ($options->type === 'enum') {
            $values = $source::select();
        }

        if ($options->type === 'model') {
            $values = $source::select('id', 'name')
                ->orderBy('name')
                ->get();
        }

        return ['values' => $values];
    }

    /**
     *  Explicity set the value for a specified field.
     *
     *  @param  string  $name
     *  @param  mixed   $data
     *  @return self
     */
    public function value($name, $data)
    {
        $populate = ['value' => $data];

        $this->field($name, $populate);

        return $this;
    }
}
