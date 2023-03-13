<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Tables\Contracts\ProvidesDefaultSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\App;

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
    protected string $resource;

    /**
     *  Return the data for the table request.
     *
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return self
     */
    public function build(Builder $builder = null)
    {
        $this->builder = $builder
            ?? App::make($this->model)::query();

        return $this;
    }

    /**
     *  Return the eloquent table builder.
     *
     *  @return \Illuminate\Database\Eloquent\Builder
     */
    public function builder(): Builder
    {
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
                        $source = key_exists('source', $filter)
                            ? $filter['source']
                            : "{$this->table}.{$index}";

                        if (gettype($value) === 'array') {
                            $this->builder->whereIn($source, $value);
                        } else {
                            $this->builder->where($source, $value);
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
     *  @return array|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function records()
    {
        $collection = collect($this->paginator->items())
            ->each(function ($item) {
                $item->actions = $this->actionsForRow($item);
            });

        return $this->resource
            ? $this->resource::from($collection)
            : $collection->toArray();
    }

    /**
     *  Apply the search to the query builder, if provided.
     *
     *  @return self
     *  @todo   Complex searching
     */
    public function search()
    {
        $wheres = [];

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

                $wheres[] = "({$searchable})";
            }
        }

        if (count($wheres)) {
            $where = implode(' AND ', $wheres);
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
        $dir = $this->request()->get('dir') < 0 ? 'desc' : 'asc';
        $sort = $this->request()->get('sort');

        if ($sort && $this->columnKeys()->contains($sort)) {
            $source = $this->columnSource($sort);

            if (gettype($source) === 'array') {
                foreach ($source as $each) {
                    $this->builder->orderBy($each, $dir);
                }

            } else {
                $this->builder->orderBy($source, $dir);
            }

        } else if ($this instanceof ProvidesDefaultSort) {
            $this->defaultSort();

        } else if ($this->defaultSort) {
            $this->builder->orderBy($this->defaultSort, $this->defaultSortDir ?? 'asc');
        }

        return $this;
    }
}
