<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Support\Collections\RequestCollection;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;

trait BuilderConstructor
{
    /** @var  object  The templated form classes. */
    protected $class;

    /** @var  object  The templated form labels direction. */
    protected $labels;

    /** @var  string  The request user. */
    protected User $user;

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
        $this->request = new RequestCollection($request->all());
        $this->user = $request->user();

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
