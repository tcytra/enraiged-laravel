<?php

namespace Enraiged\Tables\Builders\Traits;

trait TableColumns
{
    /** @var  array  The table columns. */
    protected array $columns;

    /**
     *  Return the table columns.
     *
     *  @return array
     */
    public function assembleTemplateColumns(): array
    {
        $actions = $this->hasRowActions()
            ? ['actions' => 'Actions']
            : [];

        return collect($this->columns)
            ->filter(fn ($row) => $this->assertSecure($row))
            ->transform(function ($row, $index) {
                $row['label'] = $this->columnLabel($index);

                if (!key_exists('source', $row)) {
                    $row['source'] = "{$this->table}.{$index}";
                }

                return $row;
            })
            ->merge($actions)
            ->toArray();
    }

    /**
     *  Return the column parameters identified by index.
     *
     *  @param  string  $index
     *  @return array|null
     */
    public function column(string $index): ?array
    {
        return $this->columnExists($index)
            ? $this->columns[$index]
            : null;
    }

    /**
     *  Determine if a specified column key exists.
     *
     *  @param  string  $index
     *  @return bool
     */
    public function columnExists(string $index): bool
    {
        return collect($this->columns)->keys()->contains($index);
    }

    /**
     *  Return a flat array of the column keys.
     *
     *  @return array
     */
    public function columnKeys(): array
    {
        return collect($this->columns)->keys()->flatten();
    }

    /**
     *  Return the label for the provided column key.
     *
     *  @param  string  $key
     *  @return string|null
     */
    public function columnLabel($key): ?string
    {
        $columns = collect($this->columns);

        if ($columns->has($key)) {
            $label = key_exists('label', $columns->get($key))
                ? $columns->get($key)['label']
                : ucwords(str_replace('_', ' ', $key));

            return __($label);
        }

        return null;
    }

    /**
     *  Determine the data source for a specified column, if possible.
     *
     *  @param  string  $key
     *  @return string|null
     */
    public function columnSource($key): ?string
    {
        $columns = collect($this->columns);

        if ($columns->has($key)) {
            $source = key_exists('source', $columns->get($key))
                ? $columns->get($key)['source']
                : "{$this->table}.{$key}";

            if (gettype($source) === 'array') {
                return 'concat('.collect($source)->join(",' ',").')';
            }

            return $source;
        }

        return null;
    }

    /**
     *  Return the data sources for the searchable columns.
     *
     *  @return array
     */
    public function exportableColumns(): array
    {
        return collect($this->columns)
            ->filter(fn ($column) => !key_exists('exportable', $column) || $column['exportable'] !== false)
            ->transform(fn ($column) => $column['label'])
            ->toArray();
    }

    /**
     *  Return the data sources for the searchable columns.
     *
     *  @return array
     */
    public function searchableColumns(): array
    {
        $columns = [];

        foreach ($this->columns as $key => $parameters) {
            if (key_exists('searchable', $parameters) && $parameters['searchable'] === true) {
                $source = $this->columnSource($key);

                if (gettype($source) === 'array') {
                    foreach ($source as $each) {
                        $columns[] = $each;
                    }

                } else {
                    $columns[] = $this->columnSource($key);
                }
            }
        }

        return $columns;
    }
}
