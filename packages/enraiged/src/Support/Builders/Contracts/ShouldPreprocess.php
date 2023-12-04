<?php

namespace Enraiged\Support\Builders\Contracts;

interface ShouldPreprocess
{
    /**
     *  Perform a preprocess function on an indexed item.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function preprocess($request, $item, $index);
}
