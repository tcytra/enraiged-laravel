<?php

namespace Enraiged\Forms\Builders\Traits;

trait FormFields
{
    /**
     *  Get or set a form field.
     *
     *  @param  string  $name
     *  @param  array   $params = null
     *  @param  bool    $rewrite = false
     *  @param  array   $depth = []
     *  @return array|self
     *
     *  @todo   This handles sections now also.. rename from field() to object() (or something?)
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

            if (!$this->assertSecure($object)) {
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
                if (!$this->assertSecure($object)) {
                    unset($fields[$each]);
                }

                $layers = collect($depth)->merge($each)->merge('fields');
                $search = $this->field($name, $params, $rewrite, $layers->toArray());

                if ($search) {
                    return $search;
                }
            }
        }

        return null;
    }

    /**
     *  Set a form field if the condition is true.
     *
     *  @param  string  $name
     *  @param  array   $params
     *  @param  bool|\Closure  $condition
     *  @param  bool    $rewrite = false
     *  @return self
     */
    public function fieldIf($name, $params, $condition, $rewrite = false)
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->field($name, $params, $rewrite);
        }

        return $this;
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
     *  Remove a field from the builder.
     *
     *  @return self
     */
    public function remove($name, $depth = [])
    {
        $fields = &$this->fields;

        foreach ($fields as $index => $value) {
            if ($index === $name) {
                unset($fields[$name]);
                break;
            }
            if ($this->isFormSection($index) && key_exists($name, $fields[$index])) {
                unset($fields[$index][$name]);
                break;
            }
            if ($this->hasSectionFields($fields[$index]) && key_exists($name, $fields[$index]['fields'])) {
                unset($fields[$index]['fields'][$name]);
                break;
            }
        }

        return $this;
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

    /**
     *  Explicity set the value for a specified field if the provided condition is true.
     *
     *  @param  string  $name
     *  @param  mixed   $data
     *  @param  bool|\Closure    $condition
     *  @return self
     */
    public function valueIf($name, $data, $condition)
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->value($name, $data);
        }

        return $this;
    }
}
