<?php

namespace Enraiged\Forms\Builders\Traits;

trait SanityChecks
{
    /**
     *  Determine if a field allows populating values.
     *
     *  @param  array|object  $field
     *  @return bool
     *
    protected function canPopulateValues($field): bool
    {
        $object = (object) $field;

        return !property_exists($object, 'value')
            || $object->value !== false;
    }*/

    /**
     *  Determine if a provided field requires model relationship data.
     *
     *  @param  array|object  $field
     *  @return bool
     */
    protected function hasRelativeSource($field): bool
    {
        $field = (object) $field;
        $regex = '/[a-z][a-z_]+(\.[a-z][a-z_]+){1,}/';

        if (property_exists($field, 'source')) {
            if (gettype($field->source) === 'array') {
                foreach ($field->source as $source) {
                    if (!preg_match($regex, $source)) {
                        return false;
                    }

                    return true;
                }
            }

            return preg_match($regex, $field->source);
        }

        return false;
    }

    /**
     *  Determine if the provided section has fields.
     *
     *  @param  array|object  $section
     *  @return bool
     */
    protected function hasSectionFields($section): bool
    {
        $object = (object) $section;

        return property_exists($object, 'fields')
            && $this->isFormSection($object);
    }

    /**
     *  Determine if the provided tab has fields.
     *
     *  @param  array|object  $section
     *  @return bool
     */
    protected function hasTabbedFields($section): bool
    {
        $object = (object) $section;

        return property_exists($object, 'fields')
            && $this->isFormTab($object);
    }

    /**
     *  Determine if the provided contents is a section.
     *
     *  @param  array|object  $section
     *  @return bool
     */
    protected function isFormSection($section): bool
    {
        $object = (object) $section;

        return property_exists($object, 'type')
            && $object->type === 'section';
    }

    /**
     *  Determine if the provided contents is a tab.
     *
     *  @param  array|object  $section
     *  @return bool
     */
    protected function isFormTab($section): bool
    {
        $object = (object) $section;

        return property_exists($object, 'type')
            && $object->type === 'tab';
    }
}
