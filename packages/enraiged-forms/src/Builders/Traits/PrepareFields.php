<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Forms\Traits\SelectOptions;

trait PrepareFields
{
    use SelectOptions;

    /**
     *  Prepare the form.
     *
     *  @return $this
     */
    public function prepare()
    {
        (object) $this
            ->prepareActions($this->actions)
            ->prepareFieldGroup($this->fields);

        return $this;
    }

    /**
     *  Prepare a calendar field.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return $this
     */
    protected function prepareCalendarField($name, $object = null)
    {
        $field = (object) ($object ?? $this->field($name));
        $format = $field->format ?? $field->format->dateFormat ?? 'yy-mm-dd';

        $parameters = [];

        if (property_exists($field, 'maximum')) {
            $maximum = $field->maximum === 'today' ? time() : $field->maximum;
            $parameters['maximum'] = datetime($maximum, dateformat_primevue_to_php($format));
        }

        if (property_exists($field, 'minimum')) {
            $minimum = $field->minimum === 'today' ? time() : $field->minimum;
            $parameters['minimum'] = datetime($minimum, dateformat_primevue_to_php($format));
        }

        if (count($parameters)) {
            $this->field($name, $parameters);
        }

        return $this;
    }

    /**
     *  Prepare a specified field.
     *
     *  @param  string  $name
     *  @param  object  $field = null
     *  @return $this
     */
    public function prepareField($name, $field = null)
    {
        if (gettype($name) === 'array') {
            foreach ($name as $each) {
                $this->prepareField($each, $field);
            }

            return $this;
        }

        $field = (object) ($field ?? $this->field($name));
        $value = property_exists($field, 'value') ? $field->value : null;

        //  handle the field disabled state, if necessary
        if (property_exists($field, 'disabled') && gettype($field->disabled) !== 'boolean') {
            $this->setDisabledAttribute($name, $field);
        }

        if (!property_exists($field, 'type')) {
            $field = (object) $this->field($name, [...$this->field($name), 'type' => 'text'], true);
        }

        //  prepare the calendar field options, if necessary
        if ($field->type === 'calendar') {
            $this->prepareCalendarField($name, $field);
        }

        //  prepare the multiselect field
        if ($field->type === 'multiselect') {
            $config = [
                ...$this->field($name),
                'multiple' => true,
                'type' => 'select',
            ];

            $field = (object) $this->field($name, $config, true);
        }

        //  prepare the select field options, if necessary
        if ($field->type === 'select') {
            $config = [
                ...$this->field($name),
                'multiple' => property_exists($field, 'multiple') && $field->multiple === true,
            ];

            $field = (object) $this->field($name, $config, true);
            $options = (object) $field->options;

            if (!property_exists($options, 'label') || !property_exists($options, 'value')) {
                $options->label = property_exists($options, 'label') ? $options->label : 'name';
                $options->value = property_exists($options, 'value') ? $options->value : 'id';

                $this->field($name, ['options' => $options]);

                $field = (object) $this->field($name);
            }

            if (!property_exists($field, 'values')) {
                $config = (object) $field->options;
                $source = property_exists($field, 'source') ?? $name;

                $this->field($name, ['options' => $this->selectOptions($source, $config)]);

                $field = (object) $this->field($name);
            }
        }

        //  populate the model data
        if ($field->type !== 'password') { // todo: config to supress auto-populate
            if (property_exists($field, 'data')) {
                $config = collect($field)
                    ->except('data')
                    ->merge(['source' => $field->data])
                    ->toArray();

                $field = (object) $this->field($name, $config, true);
            }

            if ($this->hasRelativeSource($field)) {
                $attribute = substr($field->source, strrpos($field->source, '.') +1);
                $relationship = substr($field->source, 0, strrpos($field->source, '.'));

                $this->model->load($relationship);

                $chain = explode('.', $relationship);
                $model = $this->model;

                while (count($chain)) {
                    $relative = array_shift($chain);

                    if (is_null($model)) {
                        break;
                    }

                    $model = $model->{$relative};
                }

                if (!is_null($model) && $model->getAttribute($attribute)) {
                    $value = $model->{$attribute};
                }

            } else if ($this->model && !is_null($this->model->getAttribute($name))) {
                $value = $this->model->getAttribute($name);
            }
        }

        //  set default values for various field types
        if (is_null($value) && property_exists($field, 'default')) {
            $value = $field->default; // todo: deprecate field default, always use value
        }
        if (is_null($value) && in_array($field->type, ['checkbox', 'switch'])) {
            if (property_exists($field, 'value') && ($field->value === true || $field->value === false)) {
                $value = $field->value;
            } else {
                $value = false;
            }
        }

        //  ensure proper format of the calendar value, if necessary
        if ($field->type === 'calendar' && !is_null($value)) {
            $format = $field->format ?? $field->format->dateFormat ?? 'yy-mm-dd';
            $value = datetime($value, dateformat_primevue_to_php($format));
        }

        //  detect and decode json strings
        if (gettype($value) === 'string') {
            $wrap = substr($value, 0, 1).substr($value, -1, 1);

            if ($wrap === '[]' || $wrap === '{}') {
                $value = json_decode($value);
            }
        }

        //  perform a sanity check on the select field value
        if ($field->type === 'select') {
            if ($field->multiple === true) {
                if (is_null($value)) {
                    $value = [];
                } else if ($value && !is_array($value)) {
                    $value = [$value];
                }

            } else if (is_array($value)) {
                $value = count($value)
                    ? $value[0]
                    : null;
            }
        }

        $this->field($name, ['value' => $value]);

        return $this;
    }

    /**
     *  Cycle and prepare a group of fields
     *
     *  @param  array  $fields
     *  @return void
     */
    protected function prepareFieldGroup($fields = null)
    {
        $keys = array_keys($fields);

        foreach ($keys as $name) {
            $object = (object) $this->field($name);

            if ($this->hasSectionFields($object) || $this->hasTabbedFields($object)) {
                $this->prepareFieldGroup($object->fields);

            //} else if ($this->canPopulateValues($object)) {
            //    $this->prepareField($name, $object);

            } else {
                //$this->field($name, ['value' => null]);
                $this->prepareField($name, $object);
            }
        }
    }

    /**
     *  Set the disabled state of a specified field, if necessary.
     *
     *  @param  string  $name
     *  @param  object  $object = null
     *  @return void
     */
    protected function setDisabledAttribute($name, $object = null)
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
}
