<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

trait PopulateFields
{
    /** @var  object  The templated form fields. */
    protected $fields;

    /** @var  Model  The form resource model. */
    protected $model;

    /**
     *  Populate the form fields with the model data.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model = null
     *  @return self
     *
     *  @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    public function populate($model = null)
    {
        if ($model instanceof Model) {
            $this->model = $model;
        }

        if (!$this->model instanceof Model) {
            throw new UnprocessableEntityHttpException(
                __('A model was not provided to populate the form with')
            );
        }

        $this->populateFieldGroup($this->fields);

        return $this;
    }

    /**
     *  Populate a specified field.
     *
     *  @param  string  $name
     *  @param  object  $params = null
     *  @return void
     */
    protected function populateField($name, $params = null)
    {
        $field = (object) ($params ?? $this->field($name));

        if ($this->fieldType($name) === 'select') {
            $this->populateFieldOptions($name, $field);
        }

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
     *  @param  object  $params = null
     *  @return void
     */
    protected function populateFieldOptions($name, $params = null)
    {
        $field = (object) ($params ?? $this->field($name));

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
