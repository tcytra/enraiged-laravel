<?php

namespace Enraiged\Tables\Traits;

trait BuilderFrom
{
    /**
     *  Create and return a builder from the request and optional parameters.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  array  $parameters = []
     *  @return \Enraiged\Tables\Builders\TableBuilder
     */
    public static function From($request, $parameters = [])
    {
        return new self($request, $parameters);
    }
}
