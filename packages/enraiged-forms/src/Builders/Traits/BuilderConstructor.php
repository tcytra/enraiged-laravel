<?php

namespace Enraiged\Forms\Builders\Traits;

use Enraiged\Forms\Contracts\ProvidesRefererRedirect;
use Enraiged\Support\Collections\RequestCollection;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

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
        $this->referer = $this instanceof ProvidesRefererRedirect
            ? $request->server('HTTP_REFERER')
            : null;

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

    /**
     *  Find and return the routing object for this route.
     *
     *  @param  string  $route
     *  @return \Illuminate\Routing\Route
     *
     *  @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     */
    private function router($route)
    {
        if (!$router = Route::getRoutes()->getByName($route)) {
            throw new UnprocessableEntityHttpException(
                __('Route :route does not exist', ['route' => $route])
            );
        }

        return $router;
    }
}
