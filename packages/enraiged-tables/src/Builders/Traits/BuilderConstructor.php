<?php

namespace Enraiged\Tables\Builders\Traits;

use Enraiged\Tables\Requests\TableRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait BuilderConstructor
{
    /** @var  string  The css class(es) to apply to the table. */
    protected string $class;

    /** @var  string  The message to display when there are no records. */
    protected string $empty;

    /** @var  string  The primary key column name. */
    protected string $key;

    /** @var  string  The route prefix. */
    protected string $prefix;

    /** @var  bool  The ability to preserve table state. */
    protected bool $state;

    /** @var  string  The table name. */
    protected string $table;

    /** @var  string  The request user. */
    protected User $user;

    /**
     *  Create an instance of the TableBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return void
     *
     *  @todo   Validate the request.
     */
    public function __construct(Request $request, array $parameters = [])
    {
        $this->request = TableRequest::createFrom($request);
        $this->user = $request->user();

        $this->load(config('enraiged.tables.template'));

        if ($this->template && File::exists($this->template)) { // todo: option to ignore config template
            $this->load(json_decode(file_get_contents($this->template), true));
        }

        if (count($parameters)) {
            $this->load($parameters);
        }

        if ($this->request->has('export')) {
            $this->exportable();
        }
    }

    /**
     *  Return the specified attribute, if possible.
     *
     *  @param  string  $attribute
     *  @return mixed
     */
    public function get(string $attribute)
    {
        return property_exists($this, $attribute)
            ? $this->{$attribute}
            : null;
    }

    /**
     *  Load a provided array of builder parameters.
     *
     *  @param  array   $parameters
     *  @return self
     */
    public function load(array $parameters)
    {
        foreach ($parameters as $parameter => $content) {
            if (property_exists($this, $parameter)) {
                $this->{$parameter} = $content;
            }
        }

        return $this;
    }

    /**
     *  Return the table route prefix.
     *
     *  @param  string  $separator = '.'
     *  @return string
     */
    public function prefix($separator = '.')
    {
        return trim($this->get('prefix'), $separator).$separator;
    }

    /**
     *  Create and return a Resource from a provided model.
     *
     *  @param  \Illuminate\Database\Eloquent\Model  $model
     *  @return 
     */
    public function resource($model)
    {
        return $this->resource::from($model);
    }

    /**
     *  Return the table user.
     *
     *  @return \Enraiged\Users\Models\User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     *  Create and return a builder from the request and optional parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters = []
     *  @return \Enraiged\Tables\Builders\TableBuilder
     *  @static
     */
    public static function From(Request $request, $parameters = [])
    {
        $called = get_called_class();

        return new $called($request, $parameters);
    }
}
