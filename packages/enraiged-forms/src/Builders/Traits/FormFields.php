<?php

namespace Enraiged\Forms\Builders\Traits;

trait FormFields
{
    /**
     *  Add a definition to the form fields template.
     *
     *  @param  mixed   $object
     *  @param  string  $name
     *  @param  string|null  $type = null
     *  @param  string|null  $parent = null
     *  @return self
     */
    public function appendFields($object, string $name, ?string $type = null, ?string $parent = null): self
    {
        if (gettype($object) === 'string') {
            $object = $this->parse($object);
        }

        if ($type) {
            $object['type'] = $type;
        }

        if (!is_null($parent)) {
            $target = $this->field($parent);

            if (key_exists('fields', $target)) {
                $target['fields'][$name] = $object;
            } else {
                $target[$name] = $object;
            }

            $this->field($parent, $target, true);

        } else {
            $this->fields[$name] = $object;
        }

        return $this;
    }

    /**
     *  Explicity set the disabled attribute for a specified field or array of fields.
     *
     *  @param  array|string  $name
     *  @return self
     */
    public function disableField($name): self
    {
        if (gettype($name) === 'array') {
            foreach ($name as $each) {
                $this->disableField($each);
            }
        } else {
            $this->field($name, ['disabled' => true]);
        }

        return $this;
    }

    /**
     *  Explicity set the disabled attribute for a specified field to the provided condition.
     *
     *  @param  array|string  $field
     *  @param  bool|\Closure $condition
     *  @return self
     */
    public function disabledIf($field, $condition): self
    {
        if (gettype($field) === 'array') {
            foreach ($field as $each) {
                $this->disabledIf($each, $condition);
            }

        } else {
            if ($condition instanceof \Closure) {
                $condition = $condition();
            }

            $this->field($field, ['disabled' => $condition]);
        }

        return $this;
    }

    /**
     *  Explicity set the disabled attribute for a specified field to the inverse of the provided condition.
     *
     *  @param  array|string  $field
     *  @param  bool|\Closure $condition
     *  @return self
     */
    public function disabledUnless($field, $condition): self
    {
        if (gettype($field) === 'array') {
            foreach ($field as $each) {
                $this->disabledUnless($each, $condition);
            }

        } else {
            if ($condition instanceof \Closure) {
                $condition = $condition();
            }

            $this->field($field, ['disabled' => !$condition]);
        }

        return $this;
    }

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

            if ($this->hasSectionFields($object) || $this->hasTabbedFields($object)) {
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
    public function fieldIf($name, $params, $condition, $rewrite = false): self
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
     *  Set a form field if the condition is not true.
     *
     *  @param  string  $name
     *  @param  array   $params
     *  @param  bool|\Closure  $condition
     *  @param  bool    $rewrite = false
     *  @return self
     */
    public function fieldUnless($name, $params, $condition, $rewrite = false): self
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if (!$condition) {
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
    protected function fieldType($name, $params = null): ?string
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
    public function remove($name): self
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
    public function value($name, $data): self
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
     *  @param  bool|\Closure $condition
     *  @param  mixed   $else = null
     *  @return self
     */
    public function valueIf($name, $data, $condition, $else = null): self
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->value($name, $data);
        } else if (func_num_args() === 4) {
            $this->value($name, $else);
        }

        return $this;
    }

    /**
     *  Explicity set the value for a specified field if the provided condition is not true.
     *
     *  @param  string  $name
     *  @param  mixed   $data
     *  @param  bool|\Closure $condition
     *  @return self
     */
    public function valueUnless($name, $data, $condition): self
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if (!$condition) {
            $this->value($name, $data);
        }

        return $this;
    }
}
