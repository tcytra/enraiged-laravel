<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Tables\Contracts\ProvidesDefaultSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

trait EloquentBuilder
{
    /** @var  \Illuminate\Database\Eloquent\Builder  The eloquent query builder. */
    protected Builder $builder;

    /** @var  string  The default sort column. */
    protected $defaultSort;

    /** @var  string  The default sort direction. */
    protected $defaultSortDir = 'asc';

    /** @var  string  The pagination parameters. */
    protected array $pagination;

    /** @var  \Illuminate\Pagination\LengthAwarePaginator  The paginator instance. */
    protected LengthAwarePaginator $paginator;

    /** @var  string  The model resource. */
    protected $resource;

    /**
     *  Set or return the eloquent table builder.
     *
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return \Illuminate\Database\Eloquent\Builder|self
     */
    public function builder(Builder $builder = null)
    {
        if ($builder) {
            $this->builder = $builder;

            return $this;
        }

        return $this->builder;
    }

    /**
     *  Apply the filtering to the query builder, if provided.
     *
     *  @return self
     */
    public function filter()
    {
        if ($this->request()->has('filters')) {
            $filters = (array) $this->request()->get('filters');

            foreach ($this->filters as $index => $filter) {
                if (!$this->assertSecure($filter)) {
                    continue;
                }

                if (key_exists($index, $filters) && $filters[$index]) {
                    $method = Str::camel("filter_{$index}");

                    if (method_exists($this, $method)) {
                        $this->{$method}($filters[$index]);

                    } else {
                        $source = key_exists('source', $filter)
                            ? $filter['source']
                            : "{$this->table}.{$index}";
                        $type = $this->filters[$index]['type'];

                        if ($type === 'daterange') {
                            [$first, $final] = $filters[$index];

                            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $first) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $final)) {
                                $first = datetimezone_at($first);
                                $final = datetimezone_at($final);

                                $this->builder->whereBetween($source, [$first, $final]);
                            }
                        }

                        if ($type === 'select') {
                            $options = key_exists('options', $filter)
                                ? $this->selectOptions($index, $filter['options'], false)
                                : [];                    

                            $value = $filters[$index];

                            $match = count($options)
                                ? collect($options['values'])->where('id', $value)->first()
                                : false;

                            if ($match && key_exists('scope', $match)) {
                                $scope = $match['scope'];
                                $this->builder->{$scope}();

                            } else {
                                if (gettype($value) === 'array') {
                                    $this->builder->whereIn($source, $value);
                                } else {
                                    $this->builder->where($source, $value);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this;
    }

    /**
     *  Execute the pagination.
     *
     *  @param  int     $rows = null
     *  @return self
     */
    public function paginate(int $rows = null)
    {
        $this->paginator = $this->builder->paginate($rows ?? $this->request->get('rows'));

        return $this;
    }

    /**
     *  Return the pagination parameters.
     *
     *  @return array
     */
    public function pagination(): array
    {
        return collect($this->paginator)
            ->except('data')
            ->toArray();
    }

    /**
     *  Return the paginated records.
     *
     *  @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Support\Collection
     */
    public function records()
    {
        $collection = $this->hasRowActions()
            ? collect($this->paginator->items())
                ->each(function ($item) {
                    $item->actions = $this->actionsForRow($item);
                })
            : collect($this->paginator->items());

        return $this->resource
            ? $this->resource::from($collection)
            : $collection;
    }

    /**
     *  Apply the search to the query builder, if provided.
     *
     *  @return self
     *  @todo   Complex searching
     */
    public function search()
    {
        $conditions = [];

        if ($this->request()->has('search') && $this->request()->filled('search')) {
            $search = $this->request()->get('search');

            foreach (explode(" ", trim($search)) as $term) {
                $term = filter_var($term);
                $searchable = collect($this->searchableColumns())
                    ->values()
                    ->transform(function ($column) use ($term) {
                        return "{$column} LIKE '%{$term}%'";
                    })
                    ->join(' OR ');

                $conditions[] = "({$searchable})";
            }
        }

        if (count($conditions)) {
            $where = implode(' AND ', $conditions);
            $query = "({$where})";

            $this->builder()->whereRaw("({$query})");
        }

        return $this;
    }

    /**
     *  Apply the sorting to the query builder, if possible.
     *
     *  @return self
     */
    public function sort()
    {
        if ($this->request()->has('sort') && $this->request()->filled('sort')) {
            $dir = $this->request()->get('dir') < 0 ? 'desc' : 'asc';
            $sort = $this->request()->get('sort');

            if ($this->columnExists($sort) && $this->isSortable($sort)) {
                $column = $this->column($sort);
                $sortable = $column['sortable'];
                $source = key_exists('source', $column) ? $column['source'] : "{$this->table}.{$sort}";

                if (gettype($source) === 'array') {
                    foreach ($source as $each) {
                        if ($sortable === 'count') {
                            $this->builder->withCount($each)->orderBy("{$each}_count", $dir);
                        } else {
                            $this->builder->orderBy($each, $dir);
                        }
                    }

                } else if ($sortable === 'count') {
                    $this->builder->withCount($source)->orderBy("{$source}_count", $dir);

                } else {
                    $this->builder->orderBy($source, $dir);
                }
            }

        } else if ($this instanceof ProvidesDefaultSort) {
            $this->defaultSort();

        } else if ($this->defaultSort) {
            $this->builder->orderBy($this->defaultSort, $this->defaultSortDir ?? 'asc');
        }

        return $this;
    }
}
