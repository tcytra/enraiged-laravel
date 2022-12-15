<?php

namespace Enraiged\Forms\Builders\Traits;

use Illuminate\Support\Facades\File;

trait BuilderConstructor
{
    /** @var  object  The templated form labels direction. */
    protected $labels;

    /**
     *  Create an instance of the FormBuilder.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters
     *  @return void
     *
     *  @todo   There is code common to the {Form,Table}Builder(s); Implement abstract parent RequestBuilder class?
     */
    public function __construct($request, array $parameters = [])
    {
        $this->request = $request;

        $this->load(config('enraiged.forms.template'));

        if ($this->template && File::exists($this->template)) { // todo: option to ignore config template
            $this->load(json_decode(file_get_contents($this->template), true));
        }

        if (count($parameters)) {
            $this->load($parameters);
        }
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
}
