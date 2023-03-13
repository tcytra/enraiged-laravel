<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Forms\Traits\SelectOptions;

trait TableFilters
{
    use SelectOptions;

    /** @var  array  The table filters. */
    protected array $filters = [];

    /**
     *  Assemble and return the table filters.
     *
     *  @return array
     */
    public function assembleTemplateFilters(): array
    {
        return collect($this->get('filters'))
            ->filter(function ($filter) {
                return $this->assertSecure($filter);
            })
            ->transform(function ($filter, $index) {
                if (!key_exists('source', $filter)) {
                    $filter['source'] = "{$this->table}.{$index}";
                }

                if (key_exists('options', $filter)) {
                    $options = $filter['options'];

                    if (!key_exists('values', $options)) {
                        //$filter['options'] = [...$options, ...$this->selectOptions($index, $options)];
                        $filter['options'] = $this->selectOptions($index, $options);

                        if (!key_exists('type', $filter)) {
                            $filter['type'] = 'select';
                        }
                    }
                }

                return $filter;
            })
            ->toArray();
    }
}
