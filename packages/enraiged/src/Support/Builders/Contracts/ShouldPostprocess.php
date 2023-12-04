<?php

namespace Enraiged\Support\Builders\Contracts;

interface ShouldPostprocess
{
    /**
     *  Perform postprocess logic on an indexed item.
     *
     *  @param  \Illuminate\Http\Request  $request
     *  @param  mixed   $item
     *  @param  string  $index
     *  @return array
     */
    public function postprocess($request, $item, $index);
}
