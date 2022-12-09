<?php

namespace Enraiged\Forms\Traits;

trait SelectOptions
{
    /**
     *  Retrieve and return a set of select options.
     *
     *  @param  array|object  $options
     *  @return array
     */
    protected function selectOptions($options)
    {
        $options = (object) $options;

        $source = $options->source;
        $values = [];

        if ($options->type === 'enum') {
            $values = $source::select();
        }

        if ($options->type === 'model') {
            $builder = $source::select('id', 'name');

            if (property_exists($options, 'scope')) {
                $builder->{$options->scope}();
            }

            $values = $builder
                ->orderBy('name')
                ->get();
        }

        return ['values' => $values];
    }
}
