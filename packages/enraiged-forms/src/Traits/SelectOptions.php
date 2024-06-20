<?php

namespace Enraiged\Forms\Traits;

use Enraiged\Support\Contracts\ProvidesDropdownOption;

trait SelectOptions
{
    /**
     *  Retrieve and return a set of select options.
     *
     *  @param  string  $source
     *  @param  array|object  $config
     *  @param  bool    $select = true
     *  @return array
     */
    protected function selectOptions($source, $config, $select = true): array
    {
        $config = (object) $config;
        $source = property_exists($config, 'source') ? $config->source : null;
        $values = property_exists($config, 'values') ? $config->values : [];

        if (count($values)) {
            return ['values' => $values];
        }

        if ($source === 'api') { // todo: should api be the 'type' and not the 'source'? add a 'method' type?
            $uri = preg_match('/\./', $config->uri)
                ? $this->route($config->uri)
                : $config->uri;

            return collect($config)
                ->merge([
                    'uri' => $uri,
                    'values' => [],
                ])
                ->toArray();
        }

        if ($select === true) {
            if (!property_exists($config, 'type')) {
                $config->type = null;
            }

            if ($config->type === 'config') {
                if ($source) {
                    $values = config($source);
                } else {
                    logger("A config source was not provided for the {$source} options", collect($config)->toArray());
                }
            }

            if ($config->type === 'enum') {
                if ($source) {
                    $values = $source::select();
                } else {
                    logger("An enum source was not provided for the {$source} options", collect($config)->toArray());
                }
            }

            if ($config->type === 'model') {
                if ($source) {
                    $builder = $source::query();

                    if (property_exists($config, 'scope')) {
                        $builder->{$config->scope}();

                    } else {
                        $columns = property_exists($config, 'select')
                            ? $config->select
                            : [$config->label ?? 'name', $config->value ?? 'id'];

                        $builder = $source::select($columns)
                            ->orderBy($config->order ?? $config->label ?? 'name');
                    }

                    $values = $builder->get()
                        ->toArray();

                    if ((new $source) instanceof ProvidesDropdownOption) {
                        $values = collect($values)
                            ->transform(fn ($model) => $model->dropdownOption())
                            ->toArray();
                    }

                } else {
                    logger("A model source was not provided for the {$source} options", collect($config)->toArray());
                }
            }
        }

        /*if (property_exists($config, 'append') && is_array($config->append) && count($config->append)) {
            $values = key_exists(0, $config->append)
                ? [...$values, ...$config->append]
                : [...$values, $config->append];
        }
        if (property_exists($config, 'prepend') && is_array($config->prepend) && count($config->prepend)) {
            $values = key_exists(0, $config->prepend)
                ? [...$config->prepend, ...$values]
                : [$config->prepend, ...$values];
        }*/

        return collect($config)
            ->merge(['values' => $values])
            ->toArray();
    }
}
