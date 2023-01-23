<?php

namespace Enraiged\Tables\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableRequest extends Request
{
    /** @var  object  The table builder. */
    protected $table;

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
     *  Return the requested sort direction.
     *
     *  @return string
     */
    public function dir()
    {
        return $this->get('dir');
    }

    /**
     *  Return the requested export parameters.
     *
     *  @return array
     */
    public function export()
    {
        return $this->get('export', []);
    }

    /**
     *  Return the requested filter parameters.
     *
     *  @return array
     */
    public function filters()
    {
        return $this->get('filters', []);
    }

    /**
     *  Return the requested row count.
     *
     *  @return string
     */
    public function rows()
    {
        return $this->get('rows');
    }

    /**
     *  Return the requested search term.
     *
     *  @return string
     */
    public function search()
    {
        return $this->get('search');
    }

    /**
     *  Return the requested sort column name.
     *
     *  @return string
     */
    public function sort()
    {
        return $this->get('sort');
    }

    /**
     *  Get the user making the request.
     *
     *  @param  string|null  $guard
     *  @return mixed
     */
    public function user($guard = null)
    {
        return Auth::guard($guard)->user();
    }
}
