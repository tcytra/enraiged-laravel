<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Database\Eloquent\Model;

trait PopulateFields
{
    /** @var  object  The templated form fields. */
    protected $fields;

    /** @var  Model  The form resource model. */
    protected $model;

    /**
     *  Populate the form fields with the model data.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  array   $resource
     *  @return self
     */
    protected function populate($model, $resource)
    {
        (object) $this
            ->model($model)
            ->resource($resource)
            ->populateFieldGroup($this->fields);

        return $this;
    }

    /**
     *  Determine the disabled state of a provided field.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return void
     */
    protected function populateDisabledAttribute($name, $object = null)
    {
        $disabled = false;

        $field = (object) ($object ?? $this->field($name));
        $config = (object) $field->disabled;
        $model = $this->model;

        //  read the disabled state from the model attribute
        if (property_exists($config, 'attribute')) {
            [$attribute, $model] = resolve_object_path($config->attribute, $model);
            $disabled = $model->{$attribute} === true;
        } else

        //  read the disabled state from the app config
        if (property_exists($config, 'config')) {
            $path = $config->config;
            $disabled = config($path) === true;
        } else

        //  read the disabled state from the model method
        if (property_exists($config, 'method')) {
            [$method, $model] = resolve_object_path($config->method, $model);
            $disabled = $model->{$method}() === true;
        }

        $this->field($name, ['disabled' => $disabled]);
    }

    /**
     *  Populate a specified field.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return void
     */
    protected function populateField($name, $object = null)
    {
        $field = (object) ($object ?? $this->field($name));

        //  handle the field disabled state, if necessary
        if (property_exists($field, 'disabled') && gettype($field->disabled) !== 'bool') {
            $this->populateDisabledAttribute($name, $field);
        }

        //  populate the select field options, if necessary
        if ($this->fieldType($name) === 'select') {
            $this->populateFieldOptions($name, $field);
        }

        //  populate the model data
        if ($this->hasRelativeData($field)) {
            $attribute = substr($field->data, strrpos($field->data, '.') +1);
            $relationship = substr($field->data, 0, strrpos($field->data, '.'));

            if (!$this->model->{$relationship}) {
                $this->model->load($relationship);
            }

            $chain = explode('.', $relationship);
            $model = $this->model;

            while (count($chain)) {
                $relative = array_shift($chain);
                $model = $model->{$relative};
            }

            $value = $model
                ? $model->{$attribute}
                : null;

        } else {
            $value = $this->model->getAttribute($name);
        }

        //  set default values for various field types
        if (is_null($value) && property_exists($field, 'default')) {
            $value = $field->default;
        }
        if (is_null($value) && $this->fieldType($name) === 'switch') {
            $value = false;
        }
        if ($this->fieldType($name) === 'password') {
            $value = null;
        }

        $this->field($name, ['value' => $value]);
    }

    /**
     *  Cycle and populate a group of fields
     *
     *  @param  array  $fields
     *  @return void
     */
    protected function populateFieldGroup($fields)
    {
        $keys = array_keys($fields);

        foreach ($keys as $name) {
            $object = (object) $this->field($name);

            if ($this->hasSectionFields($object)) {
                $this->populateFieldGroup($object->fields);

            } else if ($this->canPopulateValues($object)) {
                $this->populateField($name, $object);

            } else {
                $this->field($name, ['value' => null]);
            }
        }
    }

    /**
     *  Populate the options for a specified field.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return void
     */
    protected function populateFieldOptions($name, $object = null)
    {
        $field = (object) ($object ?? $this->field($name));

        $has_options = property_exists($field, 'options');

        if ($has_options) {
            $options = (object) $field->options;

            if (!property_exists($options, 'values')) {
                $this->field($name, [
                    'options' => $this->selectOptions($options),
                ]);
            }
        }
    }
}
