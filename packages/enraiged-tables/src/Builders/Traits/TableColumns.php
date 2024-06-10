<?php

namespace Enraiged\Tables\Builders\Traits;

use Illuminate\Support\Collection;

trait TableColumns
{
    /** @var  array  The table columns. */
    protected array $columns;

    /**
     *  Return the table columns.
     *
     *  @return array
     */
    protected function assembleTemplateColumns(): array
    {
        return collect($this->columns)
            ->filter(fn ($row) => $this->assertSecure($row))
            ->transform(function ($row, $index) {
                $row['label'] = $this->columnLabel($index);

                if (!key_exists('source', $row)) {
                    $row['source'] = "{$this->table}.{$index}";
                }

                return $row;
            })
            ->merge(
                $this->hasRowActions()
                    ? ['actions' => __('Actions')]
                    : []
            )
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
     *  Return a collection of the table columns.
     *
     *  @return \Illuminate\Support\Collection
     */
    public function columns(): Collection
    {
        return collect($this->columns);
    }

    /**
     *  Determine if a specified column key exists.
     *
     *  @param  string  $index
     *  @return bool
     */
    public function columnExists(string $index): bool
    {
        return $this->columns()
            ->keys()
            ->contains($index);
    }

    /**
     *  Return a flat array of the column keys.
     *
     *  @return array
     */
    public function columnKeys(): array
    {
        return $this->columns()
            ->keys()
            ->flatten();
    }

    /**
     *  Return the label for the provided column key.
     *
     *  @param  string  $key
     *  @return string|null
     */
    public function columnLabel($key): ?string
    {
        $columns = $this->columns();

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
        $columns = $this->columns();

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
     *  Determine whether a specified column is sortable.
     *
     *  @param  array|object|string  $column
     *  @return bool
     */
    public function isSortable($column): bool
    {
        if (gettype($column) === 'string') {
            $column = $this->column($column);
        }

        if (gettype($column) === 'array') {
            $column = (object) $column;
        }

        return property_exists($column, 'sortable') && $column->sortable !== false;
    }

    /**
     *  Remove an action from the table structure.
     *
     *  @param  string  $index
     *  @return self
     */
    public function removeColumn($index)
    {
        $this->columns = $this->columns()
            ->except($index)
            ->toArray();

        return $this;
    }

    /**
     *  Remove an action from the table structure.
     *
     *  @param  string  $index
     *  @param  boolean|\Closure  $condition
     *  @return self
     */
    public function removeColumnIf($index, $condition)
    {
        if ($condition instanceof \Closure) {
            $condition = $condition();
        }

        if ($condition) {
            $this->removeColumn($index);
        }

        return $this;
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
