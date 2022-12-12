<?php

namespace Enraiged\Tables\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

trait EloquentBuilder
{
    /** @var  object  The eloquent query builder. */
    protected $builder;

    /** @var  array  The completed pagination object. */
    protected $pagination;

    /**
     *  Return the data for the table request.
     *
     *  @param  \Illuminate\Database\Eloquent\Builder  $builder
     *  @return self
     */
    public function build(Builder $builder = null)
    {
        $this->builder = $builder ?? $this->model::query();

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
     *  @todo   Apply custom filters
     */
    public function filter()
    {
        if ($this->request()->has('filters')) {
            $filters = (array) json_decode($this->request()->get('filters'));

            if (count($filters)) {
                foreach ($this->filters as $index => $filter) {
                    if (!$this->assertSecure($filter)) {
                        continue;
                    }

                    if (key_exists($index, $filters) && $filters[$index]) {
                        $value = $filters[$index];
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
     *  @return self
     */
    public function paginate($per = null)
    {
        $per = $this->request()->get('rows', $per ?? $this->pagination['rows']);

        $this->pagination = $this->builder->paginate($per);

        return $this;
    }

    /**
     *  Return the pagination parameters.
     *
     *  @return array
     */
    public function pagination(): array
    {
        return collect($this->pagination)->except('data')->toArray();
    }

    /**
     *  Return the paginated records.
     *
     *  @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function records()
    {
        return $this->resource::from( collect($this->pagination->items()) );
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

        if ($this->request()->has('search')) {
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
        $sort = $this->request()->get('sort');

        if ($sort && $this->columnKeys()->contains($sort)) {
            $this->builder->orderBy(
                $this->columnSource($sort),
                $this->request()->get('dir') < 0 ? 'desc' : 'asc'
            );
        }

        return $this;
    }
}
