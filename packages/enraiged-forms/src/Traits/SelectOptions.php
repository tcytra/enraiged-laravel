<?php

namespace Enraiged\Forms\Traits;

trait SelectOptions
{
    /**
     *  Retrieve and return a set of select options.
     *
     *  @param  string  $name
     *  @param  array|object  $options
     *  @param  bool    $select = true
     *  @return array
     */
    protected function selectOptions($name, $options, $select = true): array
    {
        $options = (object) $options;
        $source = property_exists($options, 'source') ? $options->source : null;
        $values = property_exists($options, 'values') ? $options->values : [];

        if (count($values)) {
            return ['values' => $values];
        }

        if ($source === 'api') {
            return [
                'uri' => $this->route($options->uri),
                'values' => [],
            ];
        }

        if ($select && $options->type === 'enum') {
            if ($source) {
                $values = $source::select();
            } else {
                logger("An enum source was not provided for the {$name} options", collect($options)->toArray());
            }
        }

        if ($select && $options->type === 'model') {
            if ($source) {
                $builder = $source::select('id', 'name');

                if (property_exists($options, 'scope')) {
                    $builder->{$options->scope}();
                }

                $values = $builder
                    ->orderBy('name')
                    ->get()
                    ->toArray();
            } else {
                logger("A model source was not provided for the {$name} options", collect($options)->toArray());
            }
        }

        if (property_exists($options, 'append') && is_array($options->append) && count($options->append)) {
            $values = key_exists(0, $options->append)
                ? [...$values, ...$options->append]
                : [...$values, $options->append];
        }

        if (property_exists($options, 'prepend') && is_array($options->prepend) && count($options->prepend)) {
            $values = key_exists(0, $options->prepend)
                ? [...$options->prepend, ...$values]
                : [$options->prepend, ...$values];
        }

        return ['values' => $values];
    }
}
