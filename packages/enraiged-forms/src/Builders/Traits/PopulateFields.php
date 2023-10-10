<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Forms\Traits\SelectOptions;
use Illuminate\Database\Eloquent\Model;

trait PopulateFields
{
    use SelectOptions;

    /** @var  object  The templated form fields. */
    protected $fields;

    /** @var  Model  The form resource model. */
    protected $model;

    /**
     *  Populate the form fields with the model data.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @param  array   $resource
     *  @return $this
     */
    protected function populate($model, $resource)
    {
        (object) $this
            ->model($model)
            ->resource($resource)
            ->prepareActions($this->actions)
            ->populateFieldGroup($this->fields);

        return $this;
    }

    /**
     *  Populate the parameters for a calendar field.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return $this
     */
    protected function populateCalendarField($name, $object = null)
    {
        $field = (object) ($object ?? $this->field($name));

        $parameters = [];

        if (property_exists($field, 'maximum')) {
            $parameters['maximum'] = datetime($field->maximum, 'Y-m-d');
        }

        if (property_exists($field, 'minimum')) {
            $parameters['minimum'] = datetime($field->minimum, 'Y-m-d');
        }

        if (count($parameters)) {
            $this->field($name, $parameters);
        }

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
     *  @return $this
     */
    public function populateField($name, $object = null)
    {
        if (gettype($name) === 'array') {
            foreach ($name as $each) {
                $this->populateField($each, $object);
            }

            return $this;
        }

        $field = (object) ($object ?? $this->field($name));
        $value = null;

        //  populate the calendar field options, if necessary
        if ($this->fieldType($name) === 'calendar') {
            $this->populateCalendarField($name, $field);
        }

        //  handle the field disabled state, if necessary
        if (property_exists($field, 'disabled') && gettype($field->disabled) !== 'boolean') {
            $this->populateDisabledAttribute($name, $field);
        }

        //  populate the select field options, if necessary
        if ($this->fieldType($name) === 'select') {
            $this->populateFieldOptions($name, $field);
        }

        //  populate the model data
        if ($this->fieldType($name) !== 'password') {
            if ($this->hasRelativeData($field)) {
                $attribute = substr($field->data, strrpos($field->data, '.') +1);
                $relationship = substr($field->data, 0, strrpos($field->data, '.'));

                if (!$this->model->{$relationship}) {
                    try {
                        $this->model->load($relationship);
                    }
                    catch (\Exception $e) {}
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

            } else
            if ($this->model) {
                $value = $this->model->getAttribute($name);
            }
        }

        //  set default values for various field types
        if (is_null($value) && property_exists($field, 'default')) {
            $value = $field->default;
        }
        if (is_null($value) && in_array($this->fieldType($name), ['checkbox', 'switch'])) {
            $value = false;
        }

        $this->field($name, ['value' => $value]);

        return $this;
    }

    /**
     *  Cycle and populate a group of fields
     *
     *  @param  array  $fields
     *  @return void
     */
    protected function populateFieldGroup($fields = null)
    {
        $keys = array_keys($fields);

        foreach ($keys as $name) {
            $object = (object) $this->field($name);

            if ($this->hasSectionFields($object) || $this->hasTabbedFields($object)) {
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
                    'options' => [...$field->options, ...$this->selectOptions($name, $options)],
                ]);
            }
        }
    }
}
