<?php

namespace Enraiged\Tables\Builders\Traits;

trait TableColumns
{
    /** @var  array  The table columns. */
    protected $columns;

    /**
     *  Return the table columns.
     *
     *  @return array
     */
    public function assembleTemplateColumns(): array
    {
        return collect($this->columns)
            ->transform(function ($row, $index) {
                $row['label'] = $this->columnLabel($index);
                if (!key_exists('source', $row)) {
                    $row['source'] = "{$this->table}.{$index}";
                }
                return $row;
            })
            ->toArray();
    }

    /**
     *  Return a flat array of the column keys.
     *
     *  @return array
     */
    public function columnKeys()
    {
        return collect($this->columns)->keys()->flatten();
    }

    /**
     *  Return the label for the provided column key.
     *
     *  @param  string  $key
     *  @return string|null
     */
    public function columnLabel($key)
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
    public function columnSource($key)
    {
        $columns = collect($this->columns);

        if ($columns->has($key)) {
            return key_exists('source', $columns->get($key))
                ? $columns->get($key)['source']
                : "{$this->table}.{$key}";
        }

        return null;
    }

    /**
     *  Return the data sources for the searchable columns.
     *
     *  @return array
     */
    public function exportableColumns()
    {
        $columns = [];

        foreach ($this->columns as $key => $parameters) {
            if (!key_exists('exportable', $parameters) || $parameters['exportable'] !== false) {
                $columns[$key] = $this->columnLabel($key);
            }
        }

        return $columns;
    }

    /**
     *  Return the data sources for the searchable columns.
     *
     *  @return array
     */
    public function searchableColumns()
    {
        $columns = [];

        foreach ($this->columns as $key => $parameters) {
            if (key_exists('searchable', $parameters) && $parameters['searchable'] === true) {
                $columns[$key] = $this->columnSource($key);
            }
        }

        return $columns;
    }
}
