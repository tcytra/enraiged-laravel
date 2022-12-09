<?php

namespace Enraiged\Tables\Builders\Traits;

use Illuminate\Support\Facades\File;

trait BuilderConstructor
{
    /** @var  string  The css class(es) to apply to the table. */
    protected $class;

    /** @var  string  The message to display when there are no records. */
    protected $empty;

    /** @var  string  The primary key column name. */
    protected $key;

    /** @var  string  The route prefix. */
    protected $prefix;

    /** @var  bool  The ability to preserve table state. */
    protected $state;

    /** @var  string  The table name. */
    protected $table;

    /** @var  string  The request user. */
    protected $user;

    /**
     *  Create an instance of the TableBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array   $parameters = []
     *  @return void
     *
     *  @todo   Validate the request.
     */
    public function __construct($request, array $parameters = [])
    {
        $this->request = collect($request);
        $this->user = $request->user()->withoutRelations();

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
     *  @return \App\Auth\User
     */
    public function user()
    {
        return $this->user;
    }
}
