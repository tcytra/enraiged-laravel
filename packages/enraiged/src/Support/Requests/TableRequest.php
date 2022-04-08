<?php

namespace Enraiged\Support\Requests;

use Illuminate\Http\Request;

class TableRequest extends Request
{
    /** @var  array|string  The default query sort argument(s). */
    protected $default_sort = ['created_at', 'desc'];

    /** @var  string  The primary key column name. */
    protected $primary_key = 'id';

    /** @var  string  The table name. */
    protected $table = 'accounts';

    /**
     *  Determine if the user is authorized to make this request.
     *
     *  @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     *  Return the table columns.
     *
     *  @return type
     */
    public function columns(): array
    {
        return collect($this->columns)
            ->transform(function ($row, $index) {
                if (!key_exists('source', $row)) {
                    $row['source'] = "{$this->table}.{$index}";
                }
                return $row;
            })
            ->toArray();
    }

    /**
     *  Return the table construct for this request.
     *
     *  @return array
     */
    public function table(): array
    {
        return [
            'columns' => $this->columns(),
            'url' => $this->uri(),
        ];
    }

    /**
     *  Return the uri for the table data request.
     *
     *  @return string
     */
    public function uri(): string
    {
        $uri = $this->uri;

        if (preg_match('/\./', $uri)) {
            $uri = route($uri);
        }

        return '/'.trim($this->uri, '/');
    }
}
