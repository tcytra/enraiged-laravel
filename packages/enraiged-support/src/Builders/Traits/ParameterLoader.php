<?php

namespace Enraiged\Support\Builders\Traits;

use Illuminate\Support\Str;

trait ParameterLoader
{
    /**
     *  Load a provided array of builder parameters.
     *
     *  @param  array   $parameters
     *  @return self
     */
    protected function load(array $parameters): self
    {
        foreach ($parameters as $parameter => $content) {
            if (property_exists($this, $parameter)) {
                $method = Str::camel("set_{$parameter}");

                if (method_exists($this, $method)) {
                    $this->{$method}($content);
                } else {
                    $this->{$parameter} = $content;
                }
            }
        }

        return $this;
    }

    /**
     *  Set the builder request collection for the configuration.
     *
     *  @param  array  $parameters = []
     *  @return self
     */
    public function setParameters(array $parameters = [])
    {
        if (count($parameters)) {
            $this->load($parameters);
        }

        return $this;
    }
}
