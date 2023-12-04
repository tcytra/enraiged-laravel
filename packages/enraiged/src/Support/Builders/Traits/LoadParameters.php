<?php

namespace Enraiged\Support\Builders\Traits;

use Illuminate\Support\Str;

trait LoadParameters
{
    /**
     *  Load a provided array of builder parameters.
     *
     *  @param  array   $parameters
     *  @return self
     */
    public function load(array $parameters): self
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
}
